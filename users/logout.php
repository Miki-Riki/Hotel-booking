<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: ../index.php" . htmlspecialchars($redirect_url, ENT_QUOTES, 'UTF-8'));
exit();