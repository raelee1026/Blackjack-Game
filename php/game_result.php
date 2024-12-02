<?php
session_start();

if (!isset($_SESSION['player_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$result = $input['result'] ?? '';
$score = $input['score'] ?? 0;

if (!in_array($result, ['Win', 'Lose', 'Draw']) || !is_numeric($score)) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('INSERT INTO game_results (player_id, result, score) VALUES (:player_id, :result, :score)');
    $stmt->execute([
        'player_id' => $_SESSION['player_id'],
        'result' => $result,
        'score' => $score
    ]);

    echo json_encode(['success' => true, 'message' => 'Game result saved']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
