<!--112550003 李昀祐 第五次作業 12/06 112550003 Yun-Yu, Lee The Fith Homework 12/06 -->
<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=blackjack;charset=utf8', 'root', '');
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
