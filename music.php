<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__ . '/config.php';
    $siteUrl = rtrim(SITE_URL, '/');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music & Creativity - Cyber Mathrock</title>
    <meta name="description" content="Music and creativity of Cyber Mathrock - Guitarist and composer.">
    <link rel="canonical" href="<?php echo htmlspecialchars($siteUrl); ?>/music.php">
    
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
                    <div class="infobox-item">
                        <span class="infobox-label">LinkedIn</span>
                        <span class="infobox-value"><a href="https://www.linkedin.com/in/guilherme-monteiro-3653b51a7/" target="_blank" rel="noopener noreferrer">Profile</a></span>
                    </div>
                </div>
            </aside>

            <article class="article-content">
                <section id="music">
                    <h2>Music & Creativity</h2>
                    <p>Music is a core part of my identity. I compose, perform, and experiment with digital and analog tools, blending my technical background with creative intuition.</p>
                    
                    <h3>Guitar</h3>
                    <p>I play both 6-string and 7-string guitars, exploring various musical styles and techniques. The extended range allows for deeper tonalities and complex harmonic structures. As an instrumental musician and church guitarist, I use my musical gifts to serve and lead others in worship.</p>
                    
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for guitar and music"></div>
                    
                    <p><a href="https://youtube.com/@moonguip" target="_blank" rel="noopener noreferrer">Check out more covers on my YouTube channel →</a></p>
                    
                    <h3>Composition</h3>
                    <p>I create original compositions across various styles and genres. My work includes <strong>chiptune</strong> pieces that blend retro gaming aesthetics with modern production, <strong>piano</strong> compositions that explore emotional depth and technical complexity, and <strong>acoustic</strong> arrangements that showcase intimate, organic soundscapes.</p>
                    
                    <p>As an instrumental musician, I focus on creating music that speaks without words, using melody, harmony, and rhythm to convey emotion and tell stories. My compositions often reflect my technical background, incorporating structured approaches while maintaining creative freedom.</p>
                    
                    <p>You can find my compositions on <a href="https://soundcloud.com" target="_blank" rel="noopener noreferrer">SoundCloud</a>, where I share my latest works and experiments. Whether it's a chiptune track inspired by classic video games, a piano piece exploring new harmonic territories, or an acoustic arrangement capturing a moment of inspiration, each composition represents a unique intersection of my technical skills and creative vision.</p>
                    
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for composition and music production"></div>
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

