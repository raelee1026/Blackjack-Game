<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=blackjack;charset=utf8', 'root', '');
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
