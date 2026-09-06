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
            <div class="container admin-nav-container">
                <a class="brand" href="../home.php"><?php echo '&laquo; '.T_('Back to Site'); ?></a>
                <button id="admin-menu-toggle" class="admin-mobile-toggle" aria-label="Toggle Admin Navigation">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>
                <ul class="nav" id="admin-nav">
                    <li><a href="index.php"><?php echo T_('Dashboard'); ?></a></li>
                <!--<li><a href="upgrade.php"><?php echo T_('Upgrade'); ?></a></li>-->
                    <li><a href="config.php"><?php echo T_('Configuration'); ?></a></li>
                    <li><a href="members.php"><?php echo T_('Members'); ?></a></li>
                    <li><a href="gallery.php"><?php echo T_('Photo Gallery'); ?></a></li>
                    <li><a href="polls.php"><?php echo T_('Polls'); ?></a></li>
                    <li><a href="scheduler.php"><?php echo T_('Scheduler'); ?></a></li>
					<li><a href="backup.php"><?php echo T_('Backup'); ?></a></li>
                    <li>
                        <button type="button" id="theme-toggle-btn" class="btn-theme-toggle" aria-label="Toggle Theme">
                            <span class="theme-icon-sun">☀️ Light</span>
                            <span class="theme-icon-moon">🌙 Dark</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    (function() {
        var storedTheme = localStorage.getItem('theme');
        if (storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    })();
    </script>

    <script type="text/javascript">
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function($) {
            $('#admin-menu-toggle').on('click', function(e) {
                e.preventDefault();
                $('#admin-nav').toggleClass('admin-nav-open');
            });
        });
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('admin-menu-toggle');
            var nav = document.getElementById('admin-nav');
            if (btn && nav) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    nav.classList.toggle('admin-nav-open');
                });
            }
        });
    }
    </script>

<h1 id="page-header">
	<div class="container"><?php echo $TMPL['pagetitle']; ?></div>
</h1>

<div class="container">