<?php
/**
 * Footer Template
 * Common footer for all pages
 */
if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}
$siteUrl = rtrim(SITE_URL, '/');
?>
<footer class="page-footer">
    <p>&copy; 2025 Cyber Mathrock. Software Engineer & Music</p>
</footer>

<script src="<?php echo htmlspecialchars($siteUrl); ?>/js/toast.js?v=<?php echo ASSET_VERSION; ?>"></script>
<script src="<?php echo htmlspecialchars($siteUrl); ?>/js/theme.js?v=<?php echo ASSET_VERSION; ?>"></script>
<script src="<?php echo htmlspecialchars($siteUrl); ?>/js/search.js?v=<?php echo ASSET_VERSION; ?>"></script>
<script src="<?php echo htmlspecialchars($siteUrl); ?>/js/main.js?v=<?php echo ASSET_VERSION; ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
</body>
</html>

