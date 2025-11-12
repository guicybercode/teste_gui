<?php
// Start session for CSRF protection
session_start();

// Load configuration
require_once __DIR__ . '/config.php';

// Security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Content Security Policy
if (CSP_ENABLED) {
    // Generate nonce for inline scripts
    $nonce = base64_encode(random_bytes(16));
    $_SESSION['csp_nonce'] = $nonce;
    
    $csp = "default-src 'self'; script-src 'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data: https://fonts.gstatic.com; connect-src 'self' https://api.github.com https://api.github.com/graphql; frame-src https://www.youtube.com;";
    if (CSP_REPORT_URI) {
        $csp .= " report-uri " . CSP_REPORT_URI . ";";
    }
    header("Content-Security-Policy: " . $csp);
}

// CORS headers (restrict based on config)
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowedOrigin = '*';
if (ENVIRONMENT === 'production' && in_array(parse_url($origin, PHP_URL_HOST), CORS_ALLOWED_ORIGINS)) {
    $allowedOrigin = $origin;
} elseif (ENVIRONMENT === 'development') {
    $allowedOrigin = '*';
}
header('Access-Control-Allow-Origin: ' . $allowedOrigin);
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Use configuration constants
$chatFile = CHAT_FILE;
$rateLimitFile = CHAT_RATE_LIMIT_FILE;
$maxMessages = CHAT_MAX_MESSAGES;
$maxFileSize = CHAT_MAX_FILE_SIZE;
$rateLimitMessages = CHAT_RATE_LIMIT_MESSAGES;
$rateLimitWindow = CHAT_RATE_LIMIT_WINDOW;

// Get client IP
function getClientIP() {
    $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
    foreach ($ipKeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

// Rate limiting function
function checkRateLimit($ip, $rateLimitFile, $maxMessages, $window) {
    $rateData = [];
    if (file_exists($rateLimitFile)) {
        $content = file_get_contents($rateLimitFile);
        $rateData = json_decode($content, true) ?: [];
    }
    
    $now = time();
    $ipKey = md5($ip);
    
    // Clean old entries
    $rateData = array_filter($rateData, function($entry) use ($now, $window) {
        return ($now - $entry['time']) < $window;
    });
    
    // Check current IP
    if (isset($rateData[$ipKey])) {
        $count = 0;
        foreach ($rateData[$ipKey]['messages'] as $timestamp) {
            if (($now - $timestamp) < $window) {
                $count++;
            }
        }
        
        if ($count >= $maxMessages) {
            return false; // Rate limit exceeded
        }
        
        $rateData[$ipKey]['messages'][] = $now;
        $rateData[$ipKey]['time'] = $now;
    } else {
        $rateData[$ipKey] = [
            'messages' => [$now],
            'time' => $now
        ];
    }
    
    // Save rate limit data
    $fp = fopen($rateLimitFile, 'c+');
    if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0);
        fwrite($fp, json_encode($rateData));
        fflush($fp);
        flock($fp, LOCK_UN);
    }
    fclose($fp);
    
    return true;
}

// Initialize file if it doesn't exist
if (!file_exists($chatFile)) {
    file_put_contents($chatFile, json_encode([]));
    chmod($chatFile, 0644);
}

// Handle POST request - Send message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientIP = getClientIP();
    
    // Read and validate JSON input
    $rawInput = file_get_contents('php://input');
    if (empty($rawInput)) {
        http_response_code(400);
        echo json_encode(['error' => 'Request body is required']);
        exit;
    }
    
    $input = json_decode($rawInput, true);
    
    // Validate CSRF token
    if (!isset($input['csrf_token']) || !validateCSRFToken($input['csrf_token'])) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid CSRF token. Please refresh the page and try again.']);
        exit;
    }
    
    // Rate limiting
    if (!checkRateLimit($clientIP, $rateLimitFile, $rateLimitMessages, $rateLimitWindow)) {
        http_response_code(429);
        echo json_encode(['error' => 'Rate limit exceeded. Please wait a moment before sending another message.']);
        exit;
    }
    
    // Check file size
    if (file_exists($chatFile) && filesize($chatFile) > $maxFileSize) {
        http_response_code(413);
        echo json_encode(['error' => 'Chat file too large. Please contact administrator.']);
        exit;
    }
    
    // Validate JSON decoding
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON format: ' . json_last_error_msg()]);
        exit;
    }
    
    if (!isset($input['username']) || !isset($input['message'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Username and message are required']);
        exit;
    }
    
    $username = trim($input['username']);
    $message = trim($input['message']);
    
    // Enhanced validation
    if (empty($username) || empty($message)) {
        http_response_code(400);
        echo json_encode(['error' => 'Username and message cannot be empty']);
        exit;
    }
    
    // Validate length before sanitization
    if (strlen($username) > 50) {
        http_response_code(400);
        echo json_encode(['error' => 'Username too long (max 50 characters)']);
        exit;
    }
    if (strlen($message) > 500) {
        http_response_code(400);
        echo json_encode(['error' => 'Message too long (max 500 characters)']);
        exit;
    }
    
    // Enhanced sanitization
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
    // Validate file paths to prevent path traversal
    $chatFile = realpath(CHAT_FILE) ?: CHAT_FILE;
    if (strpos(realpath(dirname($chatFile)), realpath(__DIR__)) !== 0) {
        http_response_code(500);
        echo json_encode(['error' => 'Invalid file path']);
        exit;
    }
    
    // Read existing messages
    $messages = [];
    if (file_exists($chatFile)) {
        $content = file_get_contents($chatFile);
        $messages = json_decode($content, true) ?: [];
    }
    
    // Remove messages older than 24 hours
    $currentTime = time();
    $messages = array_filter($messages, function($msg) use ($currentTime) {
        $messageTime = isset($msg['timestamp']) ? $msg['timestamp'] : 0;
        $ageInHours = ($currentTime - $messageTime) / 3600;
        return $ageInHours < CHAT_EXPIRATION_HOURS;
    });
    $messages = array_values($messages); // Re-index array
    
    // Add new message
    $newMessage = [
        'timestamp' => $currentTime,
        'username' => $username,
        'message' => $message,
        'ip' => hash('sha256', $clientIP) // Store hashed IP for logging
    ];
    
    $messages[] = $newMessage;
    
    // Keep only last N messages
    if (count($messages) > $maxMessages) {
        $messages = array_slice($messages, -$maxMessages);
    }
    
    // Write back to file with file locking
    $fp = fopen($chatFile, 'c+');
    if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0);
        fwrite($fp, json_encode($messages, JSON_UNESCAPED_UNICODE));
        fflush($fp);
        flock($fp, LOCK_UN);
    }
    fclose($fp);
    
    // Remove IP from response for privacy
    unset($newMessage['ip']);
    
    echo json_encode(['success' => true, 'message' => $newMessage]);
    exit;
}

// Generate CSRF token
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Validate CSRF token
function validateCSRFToken($token) {
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Handle GET request - Retrieve messages
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $messages = [];
    if (file_exists($chatFile)) {
        $content = file_get_contents($chatFile);
        $messages = json_decode($content, true) ?: [];
    }
    
    // Generate and include CSRF token
    $csrfToken = generateCSRFToken();
    
    // Remove messages older than 24 hours
    $currentTime = time();
    $messages = array_filter($messages, function($msg) use ($currentTime) {
        $messageTime = isset($msg['timestamp']) ? $msg['timestamp'] : 0;
        $ageInHours = ($currentTime - $messageTime) / 3600;
        return $ageInHours < CHAT_EXPIRATION_HOURS;
    });
    $messages = array_values($messages); // Re-index array
    
    // Save cleaned messages back to file
    if (file_exists($chatFile)) {
        $fp = fopen($chatFile, 'c+');
        if (flock($fp, LOCK_EX)) {
            ftruncate($fp, 0);
            fwrite($fp, json_encode($messages));
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
    
    // Return last 50 messages
    $messages = array_slice($messages, -50);
    
    echo json_encode([
        'messages' => $messages,
        'csrf_token' => $csrfToken
    ]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
?>

