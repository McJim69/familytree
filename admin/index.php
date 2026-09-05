<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Family Tree | Admin | Dashboad</title>
<meta name="author" content="McJim Castillon Maata" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link rel="shortcut icon" href="favicon.png"/>
<link href="../ui/twitter-bootstrap/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-grid.min.css">
<link href="../ui/admin/style.css" rel="stylesheet"/>

<style>
	body { 
		padding-top: 40px; 
	}
	.addash{	
		margin:20px 10px 20px 10px;	
		border:1px solid #bbb;
		text-align:center;
		border-radius:5px;
		height:160px;
		width:160px;
		opacity:0.7;
	}
	.addash:hover{
		border-radius:5px;
		background: #fff;
		color:blue;
		opacity:1;
	}
	.flex-container {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;
	}
	.footer{
		background:#111111;		
		text-align:center;
		position:fixed;
		padding:15px;
		color:#eee;
		bottom:0;		
		right:0;
		left:0;
	}
</style>

</head>

<?php 
	session_start();	

	require("../inc/config_inc.php");

	$conn = mysqli_connect($cfg_mysql_host, $cfg_mysql_user, $cfg_mysql_pass, $cfg_mysql_db);
 
	if($conn === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>

<body id="top">

    <div class="topbar">
        <div class="fill">
            <div class="container">
                <a class="brand" href="../home.php">Back to Site</a>
                <ul class="nav">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="config.php">Configuration</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="gallery.php">Photo Gallery</a></li>
                    <li><a href="polls.php">Polls</a></li>
                    <li><a href="scheduler.php">Scheduler</a></li>
					<li><a href="backup.php">Backup</a></li>
                </ul>
            </div>
        </div>
    </div>
<br><br>

<h1><div class="container">Admin | Dashboard</div></h1>

<div class="container">
	<div class="row" style="margin:5px;background:#eee;border-radius:5px">
		<div class="col flex-container">

			<?php 
				$i=1;
				
				$ex=$conn->query("select * from admin_dashboard")or die(mysqli_error($conn));
				while($rs=mysqli_fetch_array($ex)){	
					$adid=$rs[0];
					$name=$rs["name"];
					$imgl=$rs["imgl"];
					$link=$rs["link"];
			
					echo"
					<a href='$link' style='text-decoration:none'>
						<div class='addash' 
							style='background: #fff url(../ui/img/$imgl?".date("h:i:s").")no-repeat;
								background-size:100px;
								background-position:center;
								position:relative;'>
							<div style='position:absolute;bottom:8px;left:0;right:0'>
								$name
							</div>
						</div>
					</a>";
					$i++;
				}
			?>
		</div>
	</div>	
</div>

<div class="footer">
	<div class="fill">
		<div class="container">
			Copyright &copy; 2010-<?php echo date("Y");?> <a href="#"> Family Connections</a> 
			Designed by <a href="https://mcjim-server.com/" target="_blank">McJim Cyberworks</a>
			admin@mcjim-server.com
		</div>
	</div>
</div>