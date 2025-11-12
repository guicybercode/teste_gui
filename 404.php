<?php
http_response_code(404);
require_once __DIR__ . '/config.php';
$siteUrl = rtrim(SITE_URL, '/');
$pageTitle = '404 - Page Not Found';
$pageDescription = 'The page you are looking for could not be found.';
$canonicalUrl = $siteUrl . '/404.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
            <section id="error-404">
                <h1>404 - Page Not Found</h1>
                <p>Sorry, the page you are looking for could not be found.</p>
                <p>The page may have been moved, deleted, or the URL may be incorrect.</p>
                <div style="margin-top: 2rem;">
                    <a href="<?php echo htmlspecialchars($siteUrl); ?>/index.php" class="btn-primary">Go to Home Page</a>
                </div>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

