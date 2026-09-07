<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define('URL_PREFIX', '');
define('GALLERY_PREFIX', 'gallery/');

require_once 'fcms.php';
init();

$params = array(
    'currentUserId' => isset($fcmsUser) ? $fcmsUser->id : 0,
    'sitename'      => getSiteName(),
    'nav-link'      => getNavLinks(),
    'pagetitle'     => T_('Privacy Policy'),
    'pageId'        => 'privacy',
    'path'          => URL_PREFIX,
    'displayname'   => isset($fcmsUser) ? getUserDisplayName($fcmsUser->id) : '',
    'version'       => getCurrentVersion(),
);

displayPageHeader($params);
?>
<div class="card box" style="padding: 40px; margin-top: 20px;">
	<?php require('privacy.html'); ?>
</div>
<?php
$footerParams = array(
    'path'    => URL_PREFIX,
    'version' => getCurrentVersion(),
    'year'    => date('Y')
);
loadTemplate('global', 'footer', $footerParams);
?>
