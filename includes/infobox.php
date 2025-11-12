<?php
/**
 * Infobox Template
 * Common infobox for all pages
 */
if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}
$siteUrl = rtrim(SITE_URL, '/');
?>
<aside class="infobox" role="complementary" aria-label="Personal information">
    <h2>Cyber Mathrock</h2>
    <div class="infobox-content">
        <div class="infobox-item">
            <span class="infobox-label">Location</span>
            <span class="infobox-value">Brazil</span>
        </div>
        <div class="infobox-item">
            <span class="infobox-label">Profession</span>
            <span class="infobox-value">Software Engineer & Musician</span>
        </div>
        <div class="infobox-item">
            <span class="infobox-label">Education</span>
            <span class="infobox-value">Information Systems (pursuing)</span>
        </div>
        <div class="infobox-item">
            <span class="infobox-label">Languages</span>
            <span class="infobox-value">Português, English, 한국어, ไทย, Íslenska, 台語</span>
        </div>
        <div class="infobox-item">
            <span class="infobox-label">GitHub</span>
            <span class="infobox-value"><a href="https://github.com/guicybercode" target="_blank" rel="noopener noreferrer">guicybercode</a></span>
        </div>
    </div>
</aside>

