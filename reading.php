<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Reading & Learning - Cyber Mathrock';
$pageDescription = 'Reading habits and favorite books of Cyber Mathrock.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/reading.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
            <section id="reading">
                <h2>Reading & Learning</h2>
                <p>Reading has been fundamental to my growth. It allows me to continuously learn, explore new ideas, and stay informed about technology, music, culture, and faith.</p>
                
                <h3>Favorite Books</h3>
                <p>My favorite books: <strong>The Bible</strong> (by far my number one favorite), <strong>Pachinko</strong> by Min Jin Lee, and <strong>The Hobbit</strong> by J.R.R. Tolkien.</p>
                
                <p>I read an average of <strong>30 books per month</strong>—some for enjoyment, others for projects and study. This reading habit keeps me constantly learning, whether exploring technical documentation, programming concepts, or literature from different cultures.</p>
                
                <div class="photo-placeholder" role="img" aria-label="Photo placeholder for reading and books"></div>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
