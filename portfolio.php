<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Portfolio - Cyber Mathrock';
$pageDescription = 'GitHub projects portfolio of Cyber Mathrock - Software Engineer.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/portfolio.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
            <section id="portfolio">
                <h2>Portfolio</h2>
                <p>Some of my projects from GitHub:</p>
                <div id="portfolio-container" class="portfolio-grid">
                    <div class="portfolio-loading">Loading projects...</div>
                </div>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
