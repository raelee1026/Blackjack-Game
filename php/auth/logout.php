<?php
session_start();

// 清除所有的 Session 資料
$_SESSION = [];
session_unset();
session_destroy();

// 重定向到 auth.php
header('Location: ../../auth.php');
exit;
?>
