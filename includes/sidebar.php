<?php
/**
 * Sidebar Template
 * Common sidebar for all pages
 */
if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}
$siteUrl = rtrim(SITE_URL, '/');
?>
<aside class="sidebar" role="complementary" aria-label="Site navigation">
    <div class="sidebar-content">
        <h3>Navigation</h3>
        <ul class="sidebar-menu">
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/index.php">Home</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/professional.php">Professional Background</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/portfolio.php">Portfolio</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/music.php">Music & Creativity</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/languages.php">Languages & Culture</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/reading.php">Reading & Learning</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/faith.php">Faith</a></li>
            <li><a href="<?php echo htmlspecialchars($siteUrl); ?>/chat-page.php">Live Chat</a></li>
        </ul>
        
        <div class="sidebar-section">
            <h4>Quick Info</h4>
            <p>Software Engineer & Musician from Brazil. Passionate about code, music, languages, and faith.</p>
        </div>
    </div>
</aside>

