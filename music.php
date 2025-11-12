<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Music & Creativity - Cyber Mathrock';
$pageDescription = 'Music and creativity of Cyber Mathrock - Guitarist and composer.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/music.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
            <section id="music">
                <h2>Music & Creativity</h2>
                <p>Music is a core part of my identity. I compose, perform, and experiment with digital and analog tools, blending my technical background with creative intuition.</p>
                
                <h3>Guitar</h3>
                <p>I play both 6-string and 7-string guitars, exploring various musical styles and techniques. The extended range allows for deeper tonalities and complex harmonic structures. As an instrumental musician and church guitarist, I use my musical gifts to serve and lead others in worship.</p>
                
                <div class="photo-placeholder" role="img" aria-label="Photo placeholder for guitar and music"></div>
                
                <p><a href="https://youtube.com/@moonguip" target="_blank" rel="noopener noreferrer">Check out more covers on my YouTube channel →</a></p>
                
                <h3>Composition</h3>
                <p>I create original compositions across various styles, including <strong>chiptune</strong>, <strong>piano</strong>, and <strong>acoustic</strong> pieces. As an instrumental musician, I focus on creating music that speaks without words, using melody and harmony to convey emotion.</p>
                
                <div class="photo-placeholder" role="img" aria-label="Photo placeholder for composition and music production"></div>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
