<?php
/**
 * Header Template
 * Common header for all pages
 */
if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$siteUrl = rtrim(SITE_URL, '/');
$siteDomain = SITE_DOMAIN;
$pageTitle = isset($pageTitle) ? $pageTitle : 'Cyber Mathrock - Software Engineer & Music';
$pageDescription = isset($pageDescription) ? $pageDescription : 'Personal website of Cyber Mathrock - Software Engineer & Musician. Portfolio, skills, music covers, and blog.';
$canonicalUrl = isset($canonicalUrl) ? $canonicalUrl : $siteUrl . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="software engineer, musician, guitar, programming, portfolio, cyber mathrock">
    <meta name="author" content="Cyber Mathrock">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($siteUrl); ?>/images/og-image.jpg">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($siteUrl); ?>/images/og-image.jpg">
    
    <!-- PWA -->
    <meta name="theme-color" content="<?php echo PWA_THEME_COLOR; ?>">
    <link rel="manifest" href="<?php echo htmlspecialchars($siteUrl); ?>/manifest.json">
    
    <!-- Resource Hints -->
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://api.github.com">
    <link rel="dns-prefetch" href="https://www.youtube.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://api.github.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($siteUrl); ?>/css/style.css?v=<?php echo ASSET_VERSION; ?>">
    
    <!-- Debug Mode Script -->
    <script<?php echo isset($_SESSION['csp_nonce']) ? ' nonce="' . htmlspecialchars($_SESSION['csp_nonce']) . '"' : ''; ?>>
        window.DEBUG_MODE = <?php echo DEBUG_MODE ? 'true' : 'false'; ?>;
    </script>
    
    <!-- Service Worker Registration -->
    <script<?php echo isset($_SESSION['csp_nonce']) ? ' nonce="' . htmlspecialchars($_SESSION['csp_nonce']) . '"' : ''; ?>>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .catch(() => {
                        // Service worker registration failed, continue without it
                    });
            });
        }
    </script>
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Cyber Mathrock",
        "jobTitle": "Software Engineer & Musician",
        "url": "<?php echo htmlspecialchars($siteUrl); ?>",
        "sameAs": [
            "https://github.com/guicybercode",
            "https://youtube.com/@moonguip"
        ]
    }
    </script>
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <nav class="top-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="<?php echo htmlspecialchars($siteUrl); ?>/index.php" style="text-decoration: none;">
                    <div class="logo-container" aria-label="Cyber Mathrock logo">
                        <span class="logo-cyber">CYBER</span>
                        <span class="logo-mathrock">MATHROCK</span>
                    </div>
                </a>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            <ul class="nav-links">
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/index.php">Home</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/professional.php">Professional</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/portfolio.php">Portfolio</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/music.php">Music</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/languages.php">Languages</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/reading.php">Reading</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/faith.php">Faith</a></li>
                <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/chat-page.php">Chat</a></li>
            </ul>
            <button class="theme-toggle" aria-label="Toggle dark mode" id="themeToggle">
                <i data-feather="moon"></i>
            </button>
        </div>
    </nav>

