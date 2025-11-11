<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Mathrock - Software Engineer & Musician</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-container">
                    <span class="logo-cyber">CYBER</span>
                    <span class="logo-mathrock">MATHROCK</span>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#professional">Professional</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#music">Music</a></li>
                <li><a href="#languages">Languages</a></li>
                <li><a href="#chat">Chat</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-container">
        <!-- Left Sidebar -->
        <aside class="sidebar">
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
        <main class="main-content">
            <!-- Article Header -->
            <header class="article-header">
                <div class="logo-container main-logo">
                    <span class="logo-cyber">CYBER</span>
                    <span class="logo-mathrock">MATHROCK</span>
                </div>
                <p class="subtitle">Software Engineer & Musician</p>
            </header>

            <!-- Personal Infobox (Wikipedia-style right sidebar) -->
            <aside class="infobox">
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
                        <span class="infobox-value">Portuguese, English, Korean, Thai, Icelandic</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">GitHub</span>
                        <span class="infobox-value"><a href="https://github.com/guicybercode" target="_blank">guicybercode</a></span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">LinkedIn</span>
                        <span class="infobox-value"><a href="https://www.linkedin.com/in/guilherme-monteiro-3653b51a7/" target="_blank">Profile</a></span>
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
                    <div class="photo-placeholder"></div>
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

                    <!-- GitHub Contributions Graph -->
                    <h3>GitHub Activity</h3>
                    <div class="github-graph-container">
                        <img src="https://ghchart.rshah.org/guicybercode" alt="GitHub Contributions" class="github-graph" loading="lazy">
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
                    <div class="photo-placeholder"></div>
                </section>

                <!-- Languages & Culture Section -->
                <section id="languages">
                    <h2>Languages & Culture</h2>
                    <p>Language learning is one of my passions. Fluent in Portuguese and English, conversational in Korean, Thai, and Icelandic. This multilingual ability helps me connect with global cultures and approach problems from multiple perspectives.</p>
                    
                    <!-- Photo placeholder -->
                    <div class="photo-placeholder"></div>
                </section>

                <!-- Reading & Learning Section -->
                <section id="reading">
                    <h2>Reading & Learning</h2>
                    <p>Reading has been fundamental to my growth. It allows me to continuously learn, explore new ideas, and stay informed about technology, music, culture, and faith.</p>
                </section>

                <!-- Faith Section -->
                <section id="faith">
                    <h2>Faith</h2>
                    <p>My Christian faith is very important to me and forms the foundation of my values. It guides my decisions, shapes my relationships, and influences how I view my work and creativity.</p>
                </section>

                <!-- Contact & Links Section -->
                <section id="contact">
                    <h2>Connect</h2>
                    <ul>
                        <li><strong>GitHub:</strong> <a href="https://github.com/guicybercode" target="_blank">github.com/guicybercode</a></li>
                        <li><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/guilherme-monteiro-3653b51a7/" target="_blank">linkedin.com/in/guilherme-monteiro-3653b51a7</a></li>
                    </ul>
                </section>

                <!-- Chat Section -->
                <section id="chat">
                    <h2>Live Chat</h2>
                    <div class="chat-container">
                        <div class="chat-messages" id="chatMessages">
                            <div class="chat-message">
                                <span class="chat-username">System:</span>
                                <span class="chat-text">Welcome! Feel free to leave a message.</span>
                                <span class="chat-time">Just now</span>
                            </div>
                        </div>
                        <div class="chat-input-container">
                            <input type="text" id="chatUsername" placeholder="Your name" maxlength="50">
                            <input type="text" id="chatMessage" placeholder="Type your message..." maxlength="500">
                            <button id="sendChatBtn">Send</button>
                        </div>
                    </div>
                </section>
            </article>
        </main>
    </div>

    <!-- Footer -->
    <footer class="page-footer">
        <p>&copy; 2024 Cyber Mathrock. Software Engineer & Musician.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
