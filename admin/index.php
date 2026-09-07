<?php 
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	define('URL_PREFIX', '../');
	define('GALLERY_PREFIX', '../gallery/');

	require_once URL_PREFIX.'fcms.php';
	init('admin/');

	if ($fcmsUser->access > 1) {
		header("Location: ../home.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Family Tree | Admin | Dashboard</title>
<meta name="author" content="McJim Castillon Maata" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link rel="shortcut icon" href="favicon.png"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
<link href="../ui/twitter-bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="../ui/admin/style.css?version=402" rel="stylesheet"/>

<style>
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 24px;
    margin-bottom: 40px;
}
.dash-tile {
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: 16px;
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.03);
    position: relative;
    overflow: hidden;
}
.dash-tile:hover {
    border-color: var(--admin-accent);
    transform: translateY(-4px);
    box-shadow: 0 12px 24px -6px rgba(99, 102, 241, 0.18);
}
.dash-tile-icon {
    width: 64px;
    height: 64px;
    object-fit: contain;
    margin-bottom: 16px;
    transition: transform 0.25s ease;
}
.dash-tile:hover .dash-tile-icon {
    transform: scale(1.1);
}
.dash-tile-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 15px;
    color: var(--admin-text);
    text-align: center;
    transition: color 0.2s ease;
}
.dash-tile:hover .dash-tile-title {
    color: var(--admin-accent);
}
.admin-footer {
    background: var(--admin-bg);
    color: var(--admin-text-muted);
    text-align: center;
    padding: 20px 0;
    margin-top: auto;
    border-top: 1px solid var(--admin-border);
    font-size: 14px;
}
.admin-footer a {
    color: var(--admin-accent);
    text-decoration: none;
    font-weight: 600;
}
.admin-footer a:hover {
    color: var(--admin-text);
}
</style>

</head>

<body id="top">

    <div class="topbar">
        <div class="fill">
            <div class="container admin-nav-container">
                <a class="brand" href="../home.php">&laquo; Back to Site</a>
                <button id="admin-menu-toggle" class="admin-mobile-toggle" aria-label="Toggle Admin Navigation">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>
                <ul class="nav" id="admin-nav">
                    <li class="active"><a href="index.php">Dashboard</a></li>
                    <li><a href="config.php">Configuration</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="gallery.php">Photo Gallery</a></li>
                    <li><a href="polls.php">Polls</a></li>
                    <li><a href="scheduler.php">Scheduler</a></li>
					<li><a href="backup.php">Backup</a></li>
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
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('admin-menu-toggle');
        var nav = document.getElementById('admin-nav');
        if (btn && nav) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                nav.classList.toggle('admin-nav-open');
            });
        }
        var themeBtn = document.getElementById('theme-toggle-btn');
        if (themeBtn) {
            themeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var currentTheme = document.documentElement.getAttribute('data-theme');
                var newTheme = (currentTheme === 'dark') ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        }
    });
    </script>

<h1 id="page-header">
	<div class="container">Admin | Dashboard</div>
</h1>

<div class="container">
    <div class="dashboard-grid">
        <?php 
            require_once("../inc/config_inc.php");
            $conn = mysqli_connect($cfg_mysql_host, $cfg_mysql_user, $cfg_mysql_pass, $cfg_mysql_db);
         
            if ($conn !== false) {
                $ex = $conn->query("SELECT * FROM admin_dashboard") or die(mysqli_error($conn));
                while ($rs = mysqli_fetch_array($ex)) {	
                    $name = htmlspecialchars($rs["name"]);
                    $imgl = htmlspecialchars($rs["imgl"]);
                    $link = htmlspecialchars($rs["link"]);
            
                    echo "
                    <a href='$link' class='dash-tile'>
                        <img src='../ui/img/$imgl' alt='$name' class='dash-tile-icon' />
                        <span class='dash-tile-title'>$name</span>
                    </a>";
                }
            }
        ?>
    </div>	
</div>

<footer class="admin-footer">
	<div class="container">
		Copyright &copy; 2010-<?php echo date("Y");?> <a href="../home.php">Family Connections</a> &bull; Powered by <a href="https://mcjim-server.com/" target="_blank">McJim Cyberworks</a>
	</div>
</footer>

</body>
</html>