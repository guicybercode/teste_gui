<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Server Test</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>Server Test Dashboard</h1>
        <p>Simple web application for testing your server</p>
    </header>

    <main>
        <!-- Statistics Cards -->
        <section class="stats-section">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p class="stat-number">1,234</p>
            </div>
            <div class="stat-card">
                <h3>Active Sessions</h3>
                <p class="stat-number">567</p>
            </div>
            <div class="stat-card">
                <h3>Data Processed</h3>
                <p class="stat-number">89.2 GB</p>
            </div>
            <div class="stat-card">
                <h3>Uptime</h3>
                <p class="stat-number">99.9%</p>
            </div>
        </section>

        <!-- Charts Section -->
        <section class="charts-section">
            <div class="chart-container">
                <h2>Monthly Sales Trend</h2>
                <canvas id="lineChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Product Distribution</h2>
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Category Breakdown</h2>
                <canvas id="pieChart"></canvas>
            </div>
        </section>

        <!-- Content Section -->
        <section class="content-section">
            <article class="content-card">
                <h2>Welcome to Your Dashboard</h2>
                <p>This is a simple web application designed to test your server capabilities. It includes interactive charts, content sections, image galleries, and a real-time chat system.</p>
                <p>The application is built with PHP, HTML, CSS, and JavaScript, requiring minimal dependencies and easy setup on most Linux distributions.</p>
            </article>
            <article class="content-card">
                <h2>Features</h2>
                <ul>
                    <li>Interactive charts powered by Chart.js</li>
                    <li>Real-time chat without login requirements</li>
                    <li>Responsive design for all devices</li>
                    <li>File-based storage (no database needed)</li>
                    <li>Easy installation and configuration</li>
                </ul>
            </article>
        </section>

        <!-- Image Gallery -->
        <section class="gallery-section">
            <h2>Image Gallery</h2>
            <div class="gallery">
                <div class="gallery-item">
                    <img src="images/placeholder/1354012.png" alt="Gallery Image 1">
                </div>
                <div class="gallery-item">
                    <img src="images/placeholder/1369866.png" alt="Gallery Image 2">
                </div>
            </div>
        </section>

        <!-- Chat Widget -->
        <section class="chat-section">
            <div class="chat-container">
                <h2>Live Chat</h2>
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
    </main>

    <footer>
        <p>&copy; 2024 Server Test Dashboard. Simple and lightweight.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

