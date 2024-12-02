<?php
session_start();

if (!isset($_SESSION['player_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT result, score, created_at FROM game_results WHERE player_id = :player_id ORDER BY created_at DESC');
    $stmt->execute(['player_id' => $_SESSION['player_id']]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'results' => $results]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
