<?php
$pageTitle = 'Live Chat - Cyber Mathrock';
$pageDescription = 'Live chat with Cyber Mathrock.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/chat-page.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
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

<?php include __DIR__ . '/includes/footer.php'; ?>
