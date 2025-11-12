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
                <div class="logo-container" aria-label="Cyber Mathrock logo">
                    <span class="logo-cyber">CYBER</span>
                    <span class="logo-mathrock">MATHROCK</span>
                </div>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            <ul class="nav-links">
                <li><a href="#about" aria-label="Navigate to About section">About</a></li>
                <li><a href="#professional" aria-label="Navigate to Professional section">Professional</a></li>
                <li><a href="#portfolio" aria-label="Navigate to Portfolio section">Portfolio</a></li>
                <li><a href="#music" aria-label="Navigate to Music section">Music</a></li>
                <li><a href="#languages" aria-label="Navigate to Languages section">Languages</a></li>
                <li><a href="#chat" aria-label="Navigate to Chat section">Chat</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-container">
        <!-- Left Sidebar -->
        <aside class="sidebar" role="complementary" aria-label="Site navigation">
            <div class="sidebar-content">
                <h3>Navigation</h3>
                <ul class="sidebar-menu">
                    <li><a href="#about">About Me</a></li>
                    <li><a href="#professional">Professional Background</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#music">Music & Creativity</a></li>
                    <li><a href="#languages">Languages & Culture</a></li>
                    <li><a href="#reading">Reading & Learning</a></li>
                    <li><a href="#faith">Faith</a></li>
                    <li><a href="#chat">Live Chat</a></li>
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
                    <p>Brazilian software engineer and musician pursuing Information Systems. I bridge low-level programming (C, Rust), Linux systems (Gentoo, NixOS), and scalable development with Java, Python, TypeScript, and C#. Experienced with AWS, Azure, and Oracle OCI.</p>
                    <p>Fluent in Portuguese and English, conversational in Korean, Thai, and Icelandic. As a composer and performer, I blend technical precision with creative intuition.</p>
                    
                    <!-- Photo placeholder -->
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for personal image"></div>
                </section>

                <!-- Professional Background Section -->
                <section id="professional">
                    <h2>Professional Background</h2>
                    <p>My technical journey spans from low-level systems programming to high-level application development.</p>
                    
                    <h3>Technologies</h3>
                    <ul>
                        <li><strong>Low-level:</strong> C, Rust</li>
                        <li><strong>Systems:</strong> Linux (Gentoo, NixOS)</li>
                        <li><strong>Application:</strong> Java, Python, TypeScript, C#</li>
                        <li><strong>Cloud:</strong> AWS, Azure, Oracle OCI</li>
                    </ul>

                    <!-- Skills Visualization -->
                    <h3>Skills Overview</h3>
                    <div class="skills-container">
                        <canvas id="skillsChart"></canvas>
                    </div>
                </section>

                <!-- Portfolio Section -->
                <section id="portfolio">
                    <h2>Portfolio</h2>
                    <p>Some of my projects from GitHub:</p>
                    <div id="portfolio-container" class="portfolio-grid">
                        <div class="portfolio-loading">Loading projects...</div>
                    </div>
                </section>

                <!-- Music & Creativity Section -->
                <section id="music">
                    <h2>Music & Creativity</h2>
                    <p>Music is a core part of my identity. I compose, perform, and experiment with digital and analog tools, blending my technical background with creative intuition.</p>
                    
                    <h3>Guitar</h3>
                    <p>I play both 6-string and 7-string guitars, exploring various musical styles and techniques. The extended range allows for deeper tonalities and complex harmonic structures.</p>
                    
                    <!-- Photo placeholder for guitar/music -->
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for guitar and music"></div>
                    
                    <!-- YouTube Video Embed -->
                    <h3>Featured Cover: aespa</h3>
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

                <!-- Languages & Culture Section -->
                <section id="languages">
                    <h2>Languages & Culture</h2>
                    <p>Language learning is one of my greatest passions. I speak multiple languages, each opening doors to different cultures and ways of thinking:</p>
                    
                    <ul>
                        <li><strong>Português</strong> (Portuguese) - Native</li>
                        <li><strong>English</strong> - Fluent</li>
                        <li><strong>한국어</strong> (Korean) - Conversational</li>
                        <li><strong>ไทย</strong> (Thai) - Conversational</li>
                        <li><strong>Íslenska</strong> (Icelandic) - Conversational</li>
                        <li><strong>台語</strong> (Taigi/Taiwanese) - Currently studying</li>
                    </ul>
                    
                    <p>This multilingual ability helps me connect with global cultures and approach problems from multiple perspectives. I have also worked as a translator for open-source projects, contributing translations to <strong>NixOS</strong>, <strong>Arch Linux</strong>, and other tech projects, helping make technology more accessible to speakers of different languages.</p>
                    
                    <!-- Photo placeholder -->
                    <div class="photo-placeholder" role="img" aria-label="Photo placeholder for personal image"></div>
                </section>

                <!-- Reading & Learning Section -->
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
                </section>

                <!-- Faith Section -->
                <section id="faith">
                    <h2>Faith</h2>
                    <p>My faith in Christ comes first in my life. It is the foundation of everything I do, guiding my decisions, shaping my relationships, and influencing how I view my work and creativity.</p>
                    
                    <blockquote>
                        <p><strong>Romans 8:37</strong></p>
                        <p>"No, in all these things we are more than conquerors through him who loved us."</p>
                        <p style="font-style: italic; margin-top: 0.5rem;">"Não, em todas estas coisas somos mais que vencedores, por meio daquele que nos amou."</p>
                    </blockquote>
                    
                    <p>I serve as a <strong>church guitarist</strong>, using my musical gifts to worship and lead others in praise. Music and faith are deeply intertwined in my life—each note I play is an expression of gratitude and devotion to God.</p>
                    
                    <p>My Christian faith is not just a part of who I am—it is the core of my identity. It gives me purpose, strength, and hope, and it's the lens through which I see the world and my place in it.</p>
                </section>

                <!-- Contact & Links Section -->
                <section id="contact">
                    <h2>Connect</h2>
                    <ul>
                        <li><strong>GitHub:</strong> <a href="https://github.com/guicybercode" target="_blank" rel="noopener noreferrer">github.com/guicybercode</a></li>
                        <li><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/guilherme-monteiro-3653b51a7/" target="_blank" rel="noopener noreferrer">linkedin.com/in/guilherme-monteiro-3653b51a7</a></li>
                    </ul>
                </section>

                <!-- Chat Section -->
                <section id="chat">
                    <h2>Live Chat</h2>
                    <div class="chat-container">
                        <div class="chat-messages" id="chatMessages" role="log" aria-live="polite" aria-label="Chat messages">
                            <div class="chat-message">
                                <span class="chat-username">System:</span>
                                <span class="chat-text">Welcome! Feel free to leave a message.</span>
                                <span class="chat-time">Just now</span>
                            </div>
                        </div>
                        <div class="chat-input-container">
                            <input type="text" id="chatUsername" placeholder="Your name" maxlength="50" aria-label="Your name">
                            <input type="text" id="chatMessage" placeholder="Type your message..." maxlength="500" aria-label="Type your message">
                            <button id="sendChatBtn" aria-label="Send message">Send</button>
                        </div>
                    </div>
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
