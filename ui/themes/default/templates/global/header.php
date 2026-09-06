<!DOCTYPE html>
<html lang="<?php echo T_pgettext('Language Code for this translation', 'lang'); ?>">
<head>
<title><?php echo isset($TMPL['sitename']) ? $TMPL['sitename'] : 'Maata Connections'; ?></title>
<meta charset="UTF-8"/>
<meta name="author" content="McJim Castillon Maata" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo $TMPL['path']; ?>ui/favicon.png"/>
<link rel="stylesheet" type="text/css" href="<?php echo $TMPL['path']; ?>ui/themes/default/css/style.css?version=400"/>
<link rel="stylesheet" type="text/css" href="<?php echo $TMPL['path']; ?>ui/themes/default/css/mobile.css?version=400"/>
<script type="text/javascript" src="<?php echo $TMPL['path']; ?>ui/js/jquery.js?version=350"></script>
<script type="text/javascript" src="<?php echo $TMPL['path']; ?>ui/js/fcms.js?version=350"></script>
<?php if (isset($TMPL['javascript'])) { echo $TMPL['javascript']; } ?>
</head>
<body id="top">

    <header id="header">
        <div class="header-inner">
            <div id="logo">
                <a href="<?php echo $TMPL['path']; ?>index.php">
                    <img src="<?php echo $TMPL['path']; ?>ui/img/logo.png" alt="<?php echo $TMPL['sitename'];?>"/>
                </a>
            </div>
            <div class="user-meta-bar">
                <span class="welcome-text"><?php echo T_('Welcome'); ?>, <a href="<?php echo $TMPL['path'] . "profile.php"; ?>" class="user-name"><?php echo $TMPL['displayname']; ?></a></span>
                <?php displayNewPM($TMPL['currentUserId'], $TMPL['path']); ?>
                <div class="user-actions">
                    <a href="<?php echo $TMPL['path'] . "settings.php";?>" class="btn-user-action"><?php echo T_('My Settings'); ?></a>
                    <a href="<?php echo $TMPL['path'] . "logout.php"; ?>" class="btn-user-action btn-logout"><?php echo T_('Logout'); ?></a>
                </div>
            </div>
        </div>
    </header>

<?php require_once('navigation.php'); ?>

    <main id="content">
        <div id="pagetitle"><?php echo $TMPL['pagetitle']; ?></div>
        <div id="<?php echo $TMPL['pageId']; ?>" class="centercontent">
