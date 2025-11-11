<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Test Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-logo">
                <h1>Server Test Dashboard</h1>
            </div>
            <ul class="nav-links">
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#charts">Charts</a></li>
                <li><a href="#gallery">Gallery</a></li>
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
                    <li><a href="#dashboard">Main Page</a></li>
                    <li><a href="#statistics">Statistics</a></li>
                    <li><a href="#charts">Charts</a></li>
                    <li><a href="#content">Content</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#chat">Live Chat</a></li>
                </ul>
                
                <div class="sidebar-section">
                    <h4>Quick Info</h4>
                    <p>Simple web application for testing your server capabilities.</p>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Article Header -->
            <header class="article-header">
                <h1>Server Test Dashboard</h1>
                <p class="subtitle">Simple web application for testing your server</p>
            </header>

            <!-- Statistics Infobox (Wikipedia-style right sidebar) -->
            <aside class="infobox">
                <h2>Statistics</h2>
                <div class="infobox-content">
                    <div class="infobox-item">
                        <span class="infobox-label">Total Users</span>
                        <span class="infobox-value">1,234</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">Active Sessions</span>
                        <span class="infobox-value">567</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">Data Processed</span>
                        <span class="infobox-value">89.2 GB</span>
                    </div>
                    <div class="infobox-item">
                        <span class="infobox-label">Uptime</span>
                        <span class="infobox-value">99.9%</span>
                    </div>
                </div>
            </aside>

            <!-- Article Content -->
            <article class="article-content">
                <!-- Introduction Section -->
                <section id="introduction">
                    <h2>Introduction</h2>
                    <p>This is a simple web application designed to test your server capabilities. It includes interactive charts, content sections, image galleries, and a real-time chat system.</p>
                    <p>The application is built with PHP, HTML, CSS, and JavaScript, requiring minimal dependencies and easy setup on most Linux distributions.</p>
                </section>

                <!-- Features Section -->
                <section id="features">
                    <h2>Features</h2>
                    <ul>
                        <li>Interactive charts powered by Chart.js</li>
                        <li>Real-time chat without login requirements</li>
                        <li>Responsive design for all devices</li>
                        <li>File-based storage (no database needed)</li>
                        <li>Easy installation and configuration</li>
                    </ul>
                </section>

                <!-- Charts Section -->
                <section id="charts">
                    <h2>Data Visualization</h2>
                    
                    <h3>Monthly Sales Trend</h3>
                    <div class="chart-wrapper">
                        <canvas id="lineChart"></canvas>
                    </div>

                    <h3>Product Distribution</h3>
                    <div class="chart-wrapper">
                        <canvas id="barChart"></canvas>
                    </div>

                    <h3>Category Breakdown</h3>
                    <div class="chart-wrapper">
                        <canvas id="pieChart"></canvas>
                    </div>
                </section>

                <!-- Gallery Section -->
                <section id="gallery">
                    <h2>Image Gallery</h2>
                    <div class="gallery">
                        <figure class="gallery-item">
                            <img src="images/placeholder/1354012.png" alt="Gallery Image 1">
                            <figcaption>Sample Image 1</figcaption>
                        </figure>
                        <figure class="gallery-item">
                            <img src="images/placeholder/1369866.png" alt="Gallery Image 2">
                            <figcaption>Sample Image 2</figcaption>
                        </figure>
                    </div>
                </section>

                <!-- Chat Section -->
                <section id="chat">
                    <h2>Live Chat</h2>
                    <div class="chat-container">
                        <div class="chat-messages" id="chatMessages">
                            <div class="chat-message">
                                <span class="chat-username">System:</span>
                                <span class="chat-text">Welcome! Start chatting below.</span>
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
        <p>&copy; 2024 Server Test Dashboard. Simple and lightweight.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
