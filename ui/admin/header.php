<!DOCTYPE html>
<html lang="<?php echo T_pgettext('Language Code for this translation', 'lang'); ?>">
<head>
<meta charset="utf-8">
<title><?php echo $TMPL['version']; ?></title>
<meta name="author" content="McJim Castillon Maata" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo $TMPL['path']; ?>ui/favicon.png"/>
<link href="../ui/twitter-bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $TMPL['path']; ?>ui/admin/style.css?version=400" rel="stylesheet"/>
<?php if (isset($TMPL['javascript'])) { echo $TMPL['javascript']; } ?>
</head>
<body id="top">

    <div class="topbar">
        <div class="fill">
            <div class="container">
                <a class="brand" href="../home.php"><?php echo '&laquo; '.T_('Back to Site'); ?></a>
                <ul class="nav">
                    <li><a href="index.php"><?php echo T_('Dashboard'); ?></a></li>
                <!--<li><a href="upgrade.php"><?php echo T_('Upgrade'); ?></a></li>-->
                    <li><a href="config.php"><?php echo T_('Configuration'); ?></a></li>
                    <li><a href="members.php"><?php echo T_('Members'); ?></a></li>
                    <li><a href="gallery.php"><?php echo T_('Photo Gallery'); ?></a></li>
                    <li><a href="polls.php"><?php echo T_('Polls'); ?></a></li>
                    <li><a href="scheduler.php"><?php echo T_('Scheduler'); ?></a></li>
					<li><a href="backup.php"><?php echo T_('Backup'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>

<h1 id="page-header">
	<div class="container"><?php echo $TMPL['pagetitle']; ?></div>
</h1>

<div class="container">