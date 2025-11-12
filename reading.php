<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__ . '/config.php';
    $siteUrl = rtrim(SITE_URL, '/');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading & Learning - Cyber Mathrock</title>
    <meta name="description" content="Reading habits and favorite books of Cyber Mathrock.">
    <link rel="canonical" href="<?php echo htmlspecialchars($siteUrl); ?>/reading.php">
    
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="css/style.css?v=<?php echo ASSET_VERSION; ?>">
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <nav class="top-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.php" style="text-decoration: none;">
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
                <li><a href="index.php">Home</a></li>
                <li><a href="professional.php">Professional</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="music.php">Music</a></li>
                <li><a href="languages.php">Languages</a></li>
                <li><a href="reading.php">Reading</a></li>
                <li><a href="faith.php">Faith</a></li>
                <li><a href="chat-page.php">Chat</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-container">
        <aside class="sidebar" role="complementary" aria-label="Site navigation">
            <div class="sidebar-content">
                <h3>Navigation</h3>
                <ul class="sidebar-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="professional.php">Professional Background</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="music.php">Music & Creativity</a></li>
                    <li><a href="languages.php">Languages & Culture</a></li>
                    <li><a href="reading.php">Reading & Learning</a></li>
                    <li><a href="faith.php">Faith</a></li>
                    <li><a href="chat-page.php">Live Chat</a></li>
                </ul>
                
                <div class="sidebar-section">
                    <h4>Quick Info</h4>
                    <p>Software Engineer & Musician from Brazil. Passionate about code, music, languages, and faith.</p>
                </div>
            </div>
        </aside>

        <main class="main-content" id="main-content" role="main">
            <header class="article-header"></header>

            <aside class="infobox" role="complementary" aria-label="Personal information">
                <h2>Cyber Mathrock</h2>
                <div class="infobox-content">
                    <div class="infobox-item">
                        <span class="infobox-label">Location</span>
                        <span class="infobox-value">Brazil</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">Profession</span>
                        <span class="infobox-value">Software Engineer & Musician</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">Education</span>
                        <span class="infobox-value">Information Systems (pursuing)</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">Languages</span>
                        <span class="infobox-value">Português, English, 한국어, ไทย, Íslenska, 台語</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">GitHub</span>
                        <span class="infobox-value"><a href="https://github.com/guicybercode" target="_blank" rel="noopener noreferrer">guicybercode</a></span>
                    </div>
                </div>
            </aside>

            <article class="article-content">
                <section id="reading">
                    <h2>Reading & Learning</h2>
                    <p>Reading has been fundamental to my growth. It allows me to continuously learn, explore new ideas, and stay informed about technology, music, culture, and faith.</p>
                    
                    <h3>Favorite Books</h3>
                    <p>My favorite books, in order of preference:</p>
                    <ol>
                        <li><strong>The Bible</strong> - By far my number one favorite. It's the foundation of my faith and a constant source of wisdom, guidance, and inspiration.</li>
                        <li><strong>Pachinko</strong> by Min Jin Lee - A powerful multigenerational story that deeply resonates with me.</li>
                        <li><strong>The Hobbit</strong> by J.R.R. Tolkien - A timeless adventure that sparked my love for fantasy literature.</li>
                    </ol>
                    
                    <p>I read an average of <strong>30 books per month</strong>—some for pure enjoyment and hobby, others for projects and study. This voracious reading habit keeps me constantly learning and growing, whether I'm diving into technical documentation, exploring new programming concepts, or immersing myself in literature from different cultures.</p>
                    
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for reading and books"></div>
                </section>
            </article>
        </main>
    </div>

    <footer class="page-footer">
        <p>&copy; 2025 Cyber Mathrock. Software Engineer & Music</p>
    </footer>

    <script src="js/toast.js?v=<?php echo ASSET_VERSION; ?>"></script>
    <script src="js/main.js?v=<?php echo ASSET_VERSION; ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
</body>
</html>

