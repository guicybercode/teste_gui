<?php
// Security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// CORS headers (restrict in production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$chatFile = 'chat_messages.txt';
$rateLimitFile = 'chat_rate_limit.txt';
$maxMessages = 100;
$maxFileSize = 1024 * 1024; // 1MB max file size
$rateLimitMessages = 10; // Max messages per minute per IP
$rateLimitWindow = 60; // Time window in seconds

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
    chmod($chatFile, 0666);
}

// Handle POST request - Send message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientIP = getClientIP();
    
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
    
    $input = json_decode(file_get_contents('php://input'), true);
    
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
    
    // Remove potentially dangerous characters
    $username = preg_replace('/[<>"\']/', '', $username);
    $message = preg_replace('/[<>"\']/', '', $message);
    
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
        return $ageInHours < 24;
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

// Handle GET request - Retrieve messages
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
        return $ageInHours < 24;
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
    
    echo json_encode(['messages' => $messages]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
?>

