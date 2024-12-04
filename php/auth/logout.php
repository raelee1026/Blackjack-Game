<!--112550003 李昀祐 第五次作業 12/06 112550003 Yun-Yu, Lee The Fith Homework 12/06 -->
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
