<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$chatFile = 'chat_messages.txt';
$maxMessages = 100;

// Initialize file if it doesn't exist
if (!file_exists($chatFile)) {
    file_put_contents($chatFile, json_encode([]));
    chmod($chatFile, 0666);
}

// Handle POST request - Send message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['username']) || !isset($input['message'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Username and message are required']);
        exit;
    }
    
    $username = trim($input['username']);
    $message = trim($input['message']);
    
    // Basic validation
    if (empty($username) || empty($message)) {
        http_response_code(400);
        echo json_encode(['error' => 'Username and message cannot be empty']);
        exit;
    }
    
    // Sanitize input
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
    // Limit length
    if (strlen($username) > 50) {
        $username = substr($username, 0, 50);
    }
    if (strlen($message) > 500) {
        $message = substr($message, 0, 500);
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
        return $ageInHours < 24;
    });
    $messages = array_values($messages); // Re-index array
    
    // Add new message
    $newMessage = [
        'timestamp' => time(),
        'username' => $username,
        'message' => $message
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
        fwrite($fp, json_encode($messages));
        fflush($fp);
        flock($fp, LOCK_UN);
    }
    fclose($fp);
    
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

