<?php
/**
 * RSS Feed Generator
 */
header('Content-Type: application/rss+xml; charset=utf-8');
require_once __DIR__ . '/config.php';

$siteUrl = rtrim(SITE_URL, '/');
$siteName = 'Cyber Mathrock';
$siteDescription = 'Software Engineer & Musician';

$items = [
    [
        'title' => 'Home',
        'link' => $siteUrl . '/',
        'description' => 'Personal website of Cyber Mathrock - Software Engineer & Musician',
        'pubDate' => date('r', filemtime(__DIR__ . '/index.php'))
    ],
    [
        'title' => 'Professional Background',
        'link' => $siteUrl . '/professional.php',
        'description' => 'Professional experience, skills, and technical background',
        'pubDate' => date('r', filemtime(__DIR__ . '/professional.php'))
    ],
    [
        'title' => 'Portfolio',
        'link' => $siteUrl . '/portfolio.php',
        'description' => 'GitHub projects and portfolio',
        'pubDate' => date('r', filemtime(__DIR__ . '/portfolio.php'))
    ],
    [
        'title' => 'Music & Creativity',
        'link' => $siteUrl . '/music.php',
        'description' => 'Music compositions, guitar covers, and creative work',
        'pubDate' => date('r', filemtime(__DIR__ . '/music.php'))
    ]
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
echo "  <channel>\n";
echo "    <title>" . htmlspecialchars($siteName) . "</title>\n";
echo "    <link>" . htmlspecialchars($siteUrl) . "</link>\n";
echo "    <description>" . htmlspecialchars($siteDescription) . "</description>\n";
echo "    <language>en</language>\n";
echo "    <lastBuildDate>" . date('r') . "</lastBuildDate>\n";
echo "    <atom:link href=\"" . htmlspecialchars($siteUrl) . "/rss.php\" rel=\"self\" type=\"application/rss+xml\" />\n";

foreach ($items as $item) {
    echo "    <item>\n";
    echo "      <title>" . htmlspecialchars($item['title']) . "</title>\n";
    echo "      <link>" . htmlspecialchars($item['link']) . "</link>\n";
    echo "      <description>" . htmlspecialchars($item['description']) . "</description>\n";
    echo "      <pubDate>" . $item['pubDate'] . "</pubDate>\n";
    echo "      <guid>" . htmlspecialchars($item['link']) . "</guid>\n";
    echo "    </item>\n";
}

echo "  </channel>\n";
echo "</rss>\n";
?>

