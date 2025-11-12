<?php
$pageTitle = 'Languages & Culture - Cyber Mathrock';
$pageDescription = 'Languages and cultural interests of Cyber Mathrock.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/languages.php';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
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
                
                <div class="photo-placeholder" role="img" aria-label="Photo placeholder for personal image"></div>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
