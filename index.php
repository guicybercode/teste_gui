<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // Load configuration for dynamic URLs
    require_once __DIR__ . '/config.php';
    $siteUrl = rtrim(SITE_URL, '/');
    $siteDomain = SITE_DOMAIN;
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Mathrock - Software Engineer & Music</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Personal website of Cyber Mathrock - Software Engineer & Musician. Portfolio, skills, music covers, and blog.">
    <meta name="keywords" content="software engineer, musician, guitar, programming, portfolio, cyber mathrock">
    <meta name="author" content="Cyber Mathrock">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($siteUrl); ?>/">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($siteUrl); ?>/">
    <meta property="og:title" content="Cyber Mathrock - Software Engineer & Music">
    <meta property="og:description" content="Personal website of Cyber Mathrock - Software Engineer & Musician. Portfolio, skills, music covers, and blog.">
    <meta property="og:image" content="<?php echo htmlspecialchars($siteUrl); ?>/images/og-image.jpg">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($siteUrl); ?>/">
    <meta name="twitter:title" content="Cyber Mathrock - Software Engineer & Music">
    <meta name="twitter:description" content="Personal website of Cyber Mathrock - Software Engineer & Musician. Portfolio, skills, music covers, and blog.">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($siteUrl); ?>/images/og-image.jpg">
    
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
    <link rel="stylesheet" href="css/style.css?v=<?php echo ASSET_VERSION; ?>">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Cyber Mathrock",
        "jobTitle": "Software Engineer & Musician",
        "url": "<?php echo htmlspecialchars($siteUrl); ?>",
        "sameAs": [
            "https://github.com/guicybercode",
            "https://www.linkedin.com/in/guilherme-monteiro-3653b51a7/",
            "https://youtube.com/@moonguip"
        ],
        "knowsLanguage": ["Portuguese", "English", "Korean", "Thai", "Icelandic"],
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "BR"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Cyber Mathrock",
        "url": "<?php echo htmlspecialchars($siteUrl); ?>",
        "author": {
            "@type": "Person",
            "name": "Cyber Mathrock"
        }
    }
    </script>
    
    <!-- Chart.js will be loaded dynamically when skills section is visible -->
</head>
<body>
    <!-- Skip to main content link -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Top Navigation Bar -->
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
                <li><a href="index.php" aria-label="Navigate to Home">Home</a></li>
                <li><a href="professional.php" aria-label="Navigate to Professional section">Professional</a></li>
                <li><a href="portfolio.php" aria-label="Navigate to Portfolio section">Portfolio</a></li>
                <li><a href="music.php" aria-label="Navigate to Music section">Music</a></li>
                <li><a href="languages.php" aria-label="Navigate to Languages section">Languages</a></li>
                <li><a href="reading.php" aria-label="Navigate to Reading section">Reading</a></li>
                <li><a href="faith.php" aria-label="Navigate to Faith section">Faith</a></li>
                <li><a href="chat-page.php" aria-label="Navigate to Chat section">Chat</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-container">
        <!-- Left Sidebar -->
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

        <!-- Main Content Area -->
        <main class="main-content" id="main-content" role="main">
            <!-- Article Header -->
            <header class="article-header">
            </header>

            <!-- Personal Infobox (Wikipedia-style right sidebar) -->
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

            <!-- Article Content -->
            <article class="article-content">
                <!-- About Me Section -->
                <section id="about">
                    <h2>About Me</h2>
                    <p>Brazilian Christian software engineer and musician pursuing Information Systems. I bridge low-level programming (C, Rust), Linux systems (Gentoo, NixOS), and scalable development with Java, Python, TypeScript, and C#. Experienced with AWS, Azure, and Oracle OCI.</p>
                    
                    <p>Fluent in Portuguese and English, conversational in Korean, Thai, and Icelandic. As a composer and performer, I blend technical precision with creative intuition.</p>
                    
                    <p>I'm passionate about <strong>open source</strong> and actively contribute to various projects. I've worked as a translator for <strong>NixOS</strong>, <strong>Arch Linux</strong>, and other tech projects, helping make technology more accessible to speakers of different languages. Open source is not just about code for me—it's about building community, sharing knowledge, and making technology better for everyone.</p>
                    
                    <p>Beyond code and music, I'm an avid reader (averaging 30 books per month), a language enthusiast studying multiple languages including Taigi, and a church guitarist where I serve through music. My Christian faith is the foundation of everything I do, guiding my values, decisions, and how I approach both my technical work and creative pursuits.</p>
                    
                    <p>I love exploring the intersection of technology and creativity, whether that's through composing music, contributing to open-source projects, or learning new languages and cultures. Each of these passions informs the others, creating a unique perspective that I bring to everything I do.</p>
                    
                    <!-- Photo placeholder -->
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for personal image"></div>
                </section>

                <!-- Featured Cover: aespa -->
                <section id="featured-cover">
                    <h2>Featured Cover: aespa</h2>
                    <div class="video-container">
                        <iframe 
                            width="560" 
                            height="315" 
                            src="https://www.youtube.com/embed/fvkk-S3XDEc?rel=0" 
                            title="aespa Cover" 
                            frameborder="0" 
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <p><a href="https://youtube.com/shorts/fvkk-S3XDEc" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a> | <a href="https://youtube.com/@moonguip" target="_blank" rel="noopener noreferrer">Check out more covers on my YouTube channel →</a></p>
                </section>
            </article>
        </main>
    </div>

    <!-- Footer -->
    <footer class="page-footer">
        <p>&copy; 2025 Cyber Mathrock. Software Engineer & Music</p>
    </footer>

    <script src="js/toast.js?v=<?php echo ASSET_VERSION; ?>"></script>
    <script src="js/main.js?v=<?php echo ASSET_VERSION; ?>"></script>
    <script>
        // Initialize Feather Icons after page loads
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
</body>
</html>
