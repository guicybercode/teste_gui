<?php
/**
 * Configuration File
 * Centralized configuration for the application
 */

// Site Configuration
define('SITE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
define('SITE_DOMAIN', $_SERVER['HTTP_HOST'] ?? 'localhost');

// GitHub Configuration
define('GITHUB_USERNAME', 'guicybercode');
define('GITHUB_API_CACHE_TTL', 3600); // 1 hour in seconds

// Chat Configuration
define('CHAT_FILE', __DIR__ . '/chat_messages.txt');
define('CHAT_RATE_LIMIT_FILE', __DIR__ . '/chat_rate_limit.txt');
define('CHAT_MAX_MESSAGES', 100);
define('CHAT_MAX_FILE_SIZE', 1024 * 1024); // 1MB
define('CHAT_RATE_LIMIT_MESSAGES', 10); // Max messages per window
define('CHAT_RATE_LIMIT_WINDOW', 60); // Time window in seconds
define('CHAT_EXPIRATION_HOURS', 24);

// CORS Configuration
define('CORS_ALLOWED_ORIGINS', [
    SITE_DOMAIN,
    'localhost',
    '127.0.0.1'
]);

// Security Configuration
define('CSP_ENABLED', true);
define('CSP_REPORT_URI', null); // Set to URL for CSP violation reports

// Environment
define('ENVIRONMENT', 'production'); // 'development' or 'production'
define('DEBUG_MODE', ENVIRONMENT === 'development');

