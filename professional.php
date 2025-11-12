<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Professional Background - Cyber Mathrock';
$pageDescription = 'Professional background and technical skills of Cyber Mathrock - Software Engineer.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/professional.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
            <section id="professional">
                <h2>Professional Background</h2>
                <p>Software engineer with experience in low-level programming, Linux systems, and scalable development. Currently pursuing Information Systems degree.</p>
                
                <h3>Skills Overview</h3>
                <div id="skills-section" class="skills-section">
                    <canvas id="skillsChart" width="400" height="400"></canvas>
                </div>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
