<?php
/**
 * Dynamic Sitemap Generator
 */
header('Content-Type: application/xml; charset=utf-8');
require_once __DIR__ . '/config.php';

$siteUrl = rtrim(SITE_URL, '/');
$pages = [
    ['url' => $siteUrl . '/', 'changefreq' => 'weekly', 'priority' => '1.0'],
    ['url' => $siteUrl . '/index.php', 'changefreq' => 'weekly', 'priority' => '1.0'],
    ['url' => $siteUrl . '/professional.php', 'changefreq' => 'monthly', 'priority' => '0.8'],
    ['url' => $siteUrl . '/portfolio.php', 'changefreq' => 'weekly', 'priority' => '0.9'],
    ['url' => $siteUrl . '/music.php', 'changefreq' => 'monthly', 'priority' => '0.8'],
    ['url' => $siteUrl . '/languages.php', 'changefreq' => 'monthly', 'priority' => '0.7'],
    ['url' => $siteUrl . '/reading.php', 'changefreq' => 'monthly', 'priority' => '0.7'],
    ['url' => $siteUrl . '/faith.php', 'changefreq' => 'monthly', 'priority' => '0.7'],
    ['url' => $siteUrl . '/chat-page.php', 'changefreq' => 'monthly', 'priority' => '0.6']
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($pages as $page) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($page['url']) . "</loc>\n";
    echo "    <changefreq>" . htmlspecialchars($page['changefreq']) . "</changefreq>\n";
    echo "    <priority>" . htmlspecialchars($page['priority']) . "</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>';
?>

