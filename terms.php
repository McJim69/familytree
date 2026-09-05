<html>
<head>
<title>Maata Connections</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="author" content="McJim Castillon Maata" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="ui/img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="ui/themes/blue-chrome/css/style.css?version=350"/>
<link rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)" href="ui/themes/blue-chrome/css/mobile.css"/>
<script type="text/javascript" src="ui/js/jquery.js?version=350"></script>
<script type="text/javascript" src="ui/js/fcms.js?version=350"></script>
</head>

<body>

    <div id="topmenu" style="position:fixed;top:0">
        <ul id="navigation">
            <li class="main">
                <a class="main homelink" href="index.php" title="Back to Homepage">&nbsp;</a>
            </li>
            <li class="main dropdown">
                <a class="main" href="profile.php">My Stuff</a>
                <ul class="sub">
                    <li class="sub"><a class="sub" href="profile.php">Profile</a></li>
                    <li class="sub"><a class="sub" href="settings.php">Settings</a></li>
                    <li class="sub"><a class="sub" href="privatemsg.php">Private Message</a></li>
                    <li class="sub"><a class="sub" href="notifications.php">Notifications</a></li>
                </ul>
			</li>

            <li class="main dropdown">
                <a class="main" href="messageboard.php">Communicate</a>
                <ul class="sub">
                    <li class="sub"><a class="sub" href="messageboard.php">Message Board</a></li>
                    <li class="sub"><a class="sub" href="familynews.php">Family News</a></li>
                    <li class="sub"><a class="sub" href="prayers.php">Prayers</a></li>
                </ul>
			</li>

            <li class="main dropdown">
                <a class="main" href="gallery/index.php">Share</a>
                <ul class="sub">
                    <li class="sub"><a class="sub" href="gallery/index.php">Photo Gallery</a></li>
                    <li class="sub"><a class="sub" href="video.php">Video Gallery</a></li>
                    <li class="sub"><a class="sub" href="addressbook.php">Address Book</a></li>
					<li class="sub"><a class="sub" href="calendar.php">Calendar</a></li>
					<li class="sub"><a class="sub" href="familytree.php">Family Tree</a></li>
					<li class="sub"><a class="sub" href="documents.php">Documents</a></li>
                </ul>
			</li>

            <li class="main dropdown">
                <a class="main" href="members.php">Miscellaneous</a>
                <ul class="sub">
                    <li class="sub"><a class="sub" href="members.php">Members</a></li>
                    <li class="sub"><a class="sub" href="contact.php">Contact Webmaster</a></li>
                    <li class="sub"><a class="sub" href="help.php">Help</a></li>
                </ul>
			</li>

            <span class="main">
                <a class="main" href="admin/index.php" title="Administration"> &nbsp; Administration</a>
            </span>

        </ul>
    </div>

<div align="center" style="margin-top:50px;padding:20px">
	<a href="index.php"><img src="ui/img/logo.png" /></a>
</div>

<div style="margin-top:-40px;padding:20px;">
	<?php require('terms.html'); ?>
</div>

<div align="right" style="margin-bottom:20px;padding:20px">
	<a href="privacy.php">
		<button style="background-color:#bbb;padding:5px;border:1px solid #bbb;color:darkblue;border-radius:4px;font-size:14pt">
			Go to Top
		</button>
	</a>
</div>

</body>

</html>
