<?php
ob_start();
try {
    require 'register.php';
} catch (Throwable $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
$out = ob_get_clean();
echo "OUTPUT:\n" . $out;
