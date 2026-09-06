<?php 
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
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
<title>Family Tree | Admin | Backup & Restore</title>
<meta name="author" content="McJim Castillon Maata" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="favicon.png"/>
<link href="../ui/twitter-bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="../ui/admin/style.css?version=401" rel="stylesheet"/>
<script type="text/javascript" src="../ui/js/jquery.js?version=350"></script>

<style>
.backup-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.backup-card h3 {
    margin-top: 0;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
}
.backup-card p {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 20px;
}
.backup-action-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}
.btn-modern-primary {
    background-color: #4f46e5;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-modern-primary:hover {
    background-color: #4338ca;
    color: #ffffff;
}
.btn-modern-success {
    background-color: #10b981;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-modern-success:hover {
    background-color: #059669;
    color: #ffffff;
}
.console-box {
    background: #0f172a;
    color: #38bdf8;
    font-family: 'Courier New', Courier, monospace;
    font-size: 13px;
    line-height: 1.5;
    padding: 20px;
    border-radius: 12px;
    margin-top: 24px;
    max-height: 450px;
    overflow-y: auto;
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.4);
}
.console-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #1e293b;
    padding-bottom: 10px;
    margin-bottom: 12px;
}
.console-title {
    color: #94a3b8;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="config.php">Configuration</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="gallery.php">Photo Gallery</a></li>
                    <li><a href="polls.php">Polls</a></li>
                    <li><a href="scheduler.php">Scheduler</a></li>
					<li class="active"><a href="backup.php">Backup</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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
    </script>

<h1 id="page-header">
	<div class="container">Database Backup &amp; Restoration</div>
</h1>

<div class="container">
    <div class="backup-card">
        <h3>System Backup &amp; Restore Operations</h3>
        <p>Safely export your family tree database to a compressed GZIP SQL file or restore an existing backup file.</p>
        
        <form class="user" method="post" enctype="multipart/form-data">
            <div class="backup-action-bar">
                <button class="btn-modern-primary" type="submit" name="backup" onclick="return confirm('Execute full database backup now?')">
                    Execute Backup
                </button>
                <button class="btn-modern-success" type="button" onclick="$('#file').click();">
                    Restore Backup File
                </button>
                <input type="file" name="file" id="file" onchange="$('#upload').click();" style="display:none;" />
                <input type="submit" value="Submit" name="upload" id="upload" style="display:none;" />
            </div>
        </form>
    </div>

<?php
// BACKUP LOGIC
if (isset($_POST["backup"])) {
    require_once("connect.php");

    if (!defined("BACKUP_DIR")) define("BACKUP_DIR", 'BACKUP');
    if (!defined("TABLES")) define("TABLES", '*');
    if (!defined("CHARSET")) define("CHARSET", 'utf8');
    if (!defined("GZIP_BACKUP_FILE")) define("GZIP_BACKUP_FILE", true);
    if (!defined("DISABLE_FOREIGN_KEY_CHECKS")) define("DISABLE_FOREIGN_KEY_CHECKS", true);
    if (!defined("BATCH_SIZE")) define("BATCH_SIZE", 1000);

    class Backup_Database {
        public $host;
        public $username;
        public $passwd;
        public $dbName;
        public $charset;
        public $conn;
        public $backupDir;
        public $backupFile;
        public $gzipBackupFile;
        public $output;
        public $disableForeignKeyChecks;
        public $batchSize;

        public function __construct($dbHost, $dbUser, $dbPass, $dbName, $charset = 'utf8') {
            $this->host                    = $dbHost;
            $this->username                = $dbUser;
            $this->passwd                  = $dbPass;
            $this->dbName                  = $dbName;
            $this->charset                 = $charset;
            $this->conn                    = $this->initializeDatabase();
            $this->backupDir               = BACKUP_DIR ? BACKUP_DIR : '.';
            $this->backupFile              = 'FC'.$this->dbName.'-'.date("Ymd_His", time()).'.sql';
            $this->gzipBackupFile          = defined('GZIP_BACKUP_FILE') ? GZIP_BACKUP_FILE : true;
            $this->disableForeignKeyChecks = defined('DISABLE_FOREIGN_KEY_CHECKS') ? DISABLE_FOREIGN_KEY_CHECKS : true;
            $this->batchSize               = defined('BATCH_SIZE') ? BATCH_SIZE : 1000;
            $this->output                  = '';
        }

        protected function initializeDatabase() {
            try {
                $conn = mysqli_connect($this->host, $this->username, $this->passwd, $this->dbName);
                if (mysqli_connect_errno()) {
                    throw new Exception('ERROR connecting database: ' . mysqli_connect_error());
                }
                if (!mysqli_set_charset($conn, $this->charset)) {
                    mysqli_query($conn, 'SET NAMES '.$this->charset);
                }
                return $conn;
            } catch (Exception $e) {
                echo '<div class="console-box"><span style="color:#ef4444">' . htmlspecialchars($e->getMessage()) . '</span></div>';
                return false;
            }
        }

        public function backupTables($tables = '*') {
            if (!$this->conn) return false;
            try {
                if ($tables == '*') {
                    $tables = array();
                    $result = mysqli_query($this->conn, 'SHOW TABLES');
                    while ($row = mysqli_fetch_row($result)) {
                        $tables[] = $row[0];
                    }
                } else {
                    $tables = is_array($tables) ? $tables : explode(',', str_replace(' ', '', $tables));
                }
                $sql = 'CREATE DATABASE IF NOT EXISTS `'.$this->dbName."`;\n\n";
                $sql .= 'USE `'.$this->dbName."`;\n\n";

                if ($this->disableForeignKeyChecks === true) {
                    $sql .= "SET foreign_key_checks = 0;\n\n";
                }

                foreach ($tables as $table) {
                    $this->obfPrint("Backing up `".$table."` table...", 0, 0);
                    $sql .= 'DROP TABLE IF EXISTS `'.$table.'`;';
                    $row = mysqli_fetch_row(mysqli_query($this->conn, 'SHOW CREATE TABLE `'.$table.'`'));
                    $sql .= "\n\n".$row[1].";\n\n";
                    $row = mysqli_fetch_row(mysqli_query($this->conn, 'SELECT COUNT(*) FROM `'.$table.'`'));
                    $numRows = $row[0];
                    $numBatches = intval($numRows / $this->batchSize) + 1;
                    for ($b = 1; $b <= $numBatches; $b++) {
                        $query = 'SELECT * FROM `' . $table . '` LIMIT ' . ($b * $this->batchSize - $this->batchSize) . ',' . $this->batchSize;
                        $result = mysqli_query($this->conn, $query);
                        $realBatchSize = mysqli_num_rows($result);
                        $numFields = mysqli_num_fields($result);
                        if ($realBatchSize !== 0) {
                            $sql .= 'INSERT INTO `'.$table.'` VALUES ';
                            for ($i = 0; $i < $numFields; $i++) {
                                $rowCount = 1;
                                while ($row = mysqli_fetch_row($result)) {
                                    $sql .= '(';
                                    for ($j = 0; $j < $numFields; $j++) {
                                        if (isset($row[$j])) {
                                            $row[$j] = addslashes($row[$j]);
                                            $row[$j] = str_replace("\n", "\\n", $row[$j]);
                                            $row[$j] = str_replace("\r", "\\r", $row[$j]);
                                            $row[$j] = str_replace("\f", "\\f", $row[$j]);
                                            $row[$j] = str_replace("\t", "\\t", $row[$j]);
                                            $row[$j] = str_replace("\v", "\\v", $row[$j]);
                                            $row[$j] = str_replace("\a", "\\a", $row[$j]);
                                            $row[$j] = str_replace("\b", "\\b", $row[$j]);
                                            if ($row[$j] == 'true' or $row[$j] == 'false' or preg_match('/^-?[0-9]+$/', $row[$j]) or $row[$j] == 'NULL' or $row[$j] == 'null') {
                                                $sql .= $row[$j];
                                            } else {
                                                $sql .= '"'.$row[$j].'"';
                                            }
                                        } else {
                                            $sql .= 'NULL';
                                        }
                                        if ($j < ($numFields - 1)) {
                                            $sql .= ',';
                                        }
                                    }
                                    if ($rowCount == $realBatchSize) {
                                        $rowCount = 0;
                                        $sql .= ");\n";
                                    } else {
                                        $sql .= "),\n";
                                    }
                                    $rowCount++;
                                }
                            }
                            $this->saveFile($sql);
                            $sql = '';
                        }
                    }
                    $sql .= "\n\n";
                    $this->obfPrint(' <span style="color:#10b981;font-weight:bold">SUCCESS!</span>');
                }
                if ($this->disableForeignKeyChecks === true) {
                    $sql .= "SET foreign_key_checks = 1;\n";
                }
                $this->saveFile($sql);
                if ($this->gzipBackupFile) {
                    $this->gzipBackupFile();
                } else {
                    $this->obfPrint('Backup file successfully saved to ' . $this->backupDir.'/'.$this->backupFile, 1, 1);
                }
            } catch (Exception $e) {
                $this->obfPrint(' <span style="color:#ef4444;font-weight:bold">FAILED: ' . htmlspecialchars($e->getMessage()) . '</span>');
                return false;
            }
            return true;
        }

        protected function saveFile(&$sql) {
            if (!$sql) return false;
            try {
                if (!file_exists($this->backupDir)) {
                    mkdir($this->backupDir, 0777, true);
                }
                file_put_contents($this->backupDir.'/'.$this->backupFile, $sql, FILE_APPEND | LOCK_EX);
            } catch (Exception $e) {
                return false;
            }
            return true;
        }

        protected function gzipBackupFile($level = 9) {
            if (!$this->gzipBackupFile) {
                return true;
            }
            $source = $this->backupDir . '/' . $this->backupFile;
            $dest = $source . '.gz';
            $this->obfPrint('Compressing Backup File to ' . $dest . '...', 1, 0);
            $mode = 'wb' . $level;
            if ($fpOut = gzopen($dest, $mode)) {
                if ($fpIn = fopen($source, 'rb')) {
                    while (!feof($fpIn)) {
                        gzwrite($fpOut, fread($fpIn, 1024 * 256));
                    }
                    fclose($fpIn);
                } else {
                    return false;
                }
                gzclose($fpOut);
                if (!unlink($source)) {
                    return false;
                }
            } else {
                return false;
            }

            $this->obfPrint(' <span style="color:#10b981;font-weight:bold">SUCCESS!</span>');
            echo '<div style="margin-top:16px"><a href="'.$dest.'" class="btn-modern-success" style="text-decoration:none;display:inline-block">Download Backup Package</a></div>';
            return $dest;
        }

        public function obfPrint($msg = '', $lineBreaksBefore = 0, $lineBreaksAfter = 1) {
            if (!$msg) return false;
            $output = '';
            $lineBreak = "<br />";
            if ($lineBreaksBefore > 0) {
                for ($i = 1; $i <= $lineBreaksBefore; $i++) {
                    $output .= $lineBreak;
                }                
            }
            $output .= $msg;
            if ($lineBreaksAfter > 0) {
                for ($i = 1; $i <= $lineBreaksAfter; $i++) {
                    $output .= $lineBreak;
                }                
            }
            echo $output;
            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();
        }
    }

    set_time_limit(900);
    echo '<div class="console-box">';
    echo '<div class="console-header"><span class="console-title">Console Output</span><a href="backup.php" style="color:#ef4444;text-decoration:none;font-weight:600">Clear Console</a></div>';
    $backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, CHARSET);
    $backupDatabase->backupTables(TABLES);
    echo '</div>';
}

// RESTORE LOGIC
if (isset($_POST["upload"])) {
    if (!file_exists("BACKUP")) {
        mkdir("BACKUP", 0777, true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'], "BACKUP/backup-sql.sql.gz");
    $file = "backup-sql.sql.gz";

    require_once("connect.php");
    if (!defined("BACKUP_DIR")) define("BACKUP_DIR", 'BACKUP');
    if (!defined("BACKUP_FILE")) define("BACKUP_FILE", $file);
    if (!defined("CHARSET")) define("CHARSET", 'utf8');
    if (!defined("DISABLE_FOREIGN_KEY_CHECKS")) define("DISABLE_FOREIGN_KEY_CHECKS", true);

    class Restore_Database {
        public $host;
        public $username;
        public $passwd;
        public $dbName;
        public $charset;
        public $conn;
        public $disableForeignKeyChecks;
        public $backupDir;
        public $backupFile;

        public function __construct($dbHost, $dbUser, $dbPass, $dbName, $charset = 'utf8') {
            $this->host                    = $dbHost;
            $this->username                = $dbUser;
            $this->passwd                  = $dbPass;
            $this->dbName                  = $dbName;
            $this->charset                 = $charset;
            $this->disableForeignKeyChecks = defined('DISABLE_FOREIGN_KEY_CHECKS') ? DISABLE_FOREIGN_KEY_CHECKS : true;
            $this->conn                    = $this->initializeDatabase();
            $this->backupDir               = defined('BACKUP_DIR') ? BACKUP_DIR : '.';
            $this->backupFile              = defined('BACKUP_FILE') ? BACKUP_FILE : null;
        }

        public function __destruct() {
            if ($this->conn && $this->disableForeignKeyChecks === true) {
                mysqli_query($this->conn, 'SET foreign_key_checks = 1');
            }
        }

        protected function initializeDatabase() {
            try {
                $conn = mysqli_connect($this->host, $this->username, $this->passwd, $this->dbName);
                if (mysqli_connect_errno()) {
                    throw new Exception('ERROR connecting database: ' . mysqli_connect_error());
                }
                if (!mysqli_set_charset($conn, $this->charset)) {
                    mysqli_query($conn, 'SET NAMES '.$this->charset);
                }
                if ($this->disableForeignKeyChecks === true) {
                    mysqli_query($conn, 'SET foreign_key_checks = 0');
                }
                return $conn;
            } catch (Exception $e) {
                echo '<div class="console-box"><span style="color:#ef4444">' . htmlspecialchars($e->getMessage()) . '</span></div>';
                return false;
            }
        }

        public function restoreDb() {
            if (!$this->conn) return false;
            try {
                $sql = '';
                $multiLineComment = false;
                $backupDir = $this->backupDir;
                $backupFile = $this->backupFile;
                $backupFileIsGzipped = substr($backupFile, -3, 3) == '.gz' ? true : false;
                if ($backupFileIsGzipped) {
                    if (!$backupFile = $this->gunzipBackupFile()) {
                        throw new Exception("ERROR: couldn't gunzip backup file " . $backupDir . '/' . $backupFile);
                    }
                }
                $handle = fopen($backupDir . '/' . $backupFile, "r");
                if ($handle) {
                    while (($line = fgets($handle)) !== false) {
                        $line = ltrim(rtrim($line));
                        if (strlen($line) > 1) {
                            $lineIsComment = false;
                            if (preg_match('/^\/\*/', $line)) {
                                $multiLineComment = true;
                                $lineIsComment = true;
                            }
                            if ($multiLineComment or preg_match('/^\/\//', $line)) {
                                $lineIsComment = true;
                            }
                            if (!$lineIsComment) {
                                $sql .= $line;
                                if (preg_match('/;$/', $line)) {
                                    if (mysqli_query($this->conn, $sql)) {
                                        if (preg_match('/^CREATE TABLE `([^`]+)`/i', $sql, $tableName)) {
                                            $this->obfPrint("Table successfully restored: `" . $tableName[1] . "`");
                                        }
                                        $sql = '';
                                    } else {
                                        throw new Exception("ERROR: SQL execution error: " . mysqli_error($this->conn));
                                    }
                                }
                            } else if (preg_match('/\*\/$/', $line)) {
                                $multiLineComment = false;
                            }
                        }
                    }
                    fclose($handle);
                } else {
                    throw new Exception("ERROR: couldn't open backup file " . $backupDir . '/' . $backupFile);
                }
            } catch (Exception $e) {
                $this->obfPrint('<span style="color:#ef4444;font-weight:bold">ERROR: ' . htmlspecialchars($e->getMessage()) . '</span>');
                return false;
            }
            if ($backupFileIsGzipped) {
                @unlink($backupDir . '/' . $backupFile);
            }
            return true;
        }

        protected function gunzipBackupFile() {
            $bufferSize = 4096;
            $source = $this->backupDir . '/' . $this->backupFile;
            $dest = $this->backupDir . '/' . date("Ymd_His", time()) . '_' . substr($this->backupFile, 0, -3);
            $this->obfPrint('Uncompressing backup package...', 1, 1);
            if (file_exists($dest)) {
                if (!unlink($dest)) {
                    return false;
                }
            }
            if (!$srcFile = gzopen($this->backupDir . '/' . $this->backupFile, 'rb')) {
                return false;
            }
            if (!$dstFile = fopen($dest, 'wb')) {
                return false;
            }
            while (!gzeof($srcFile)) {
                if (!fwrite($dstFile, gzread($srcFile, $bufferSize))) {
                    return false;
                }
            }
            fclose($dstFile);
            gzclose($srcFile);
            return str_replace($this->backupDir . '/', '', $dest);
        }

        public function obfPrint($msg = '', $lineBreaksBefore = 0, $lineBreaksAfter = 1) {
            if (!$msg) return false;
            $output = '';
            $lineBreak = "<br />";
            if ($lineBreaksBefore > 0) {
                for ($i = 1; $i <= $lineBreaksBefore; $i++) {
                    $output .= $lineBreak;
                }                
            }
            $output .= $msg;
            if ($lineBreaksAfter > 0) {
                for ($i = 1; $i <= $lineBreaksAfter; $i++) {
                    $output .= $lineBreak;
                }                
            }
            echo $output;
            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();
        }
    }

    set_time_limit(900);
    echo '<div class="console-box">';
    echo '<div class="console-header"><span class="console-title">Restore Console Output</span><a href="backup.php" style="color:#ef4444;text-decoration:none;font-weight:600">Clear Console</a></div>';
    $restoreDatabase = new Restore_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = $restoreDatabase->restoreDb() ? '<span style="color:#10b981;font-weight:bold">SUCCESS!</span>' : '<span style="color:#ef4444;font-weight:bold">FAILED!</span>';
    $restoreDatabase->obfPrint("Restoration result: ".$result, 1);
    echo '</div>';
    @unlink("BACKUP/backup-sql.sql.gz");
}
?>

</div>
</body>
</html>