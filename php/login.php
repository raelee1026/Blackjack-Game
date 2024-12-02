<?php
session_start();
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'] ?? '';

if (!empty($username)) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 檢查用戶是否已存在
        $stmt = $pdo->prepare('SELECT id FROM players WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $player = $stmt->fetch();

        if (!$player) {
            // 新增用戶
            $stmt = $pdo->prepare('INSERT INTO players (username) VALUES (:username)');
            $stmt->execute(['username' => $username]);
            $playerId = $pdo->lastInsertId();
        } else {
            $playerId = $player['id'];
        }

        $_SESSION['username'] = $username;
        $_SESSION['player_id'] = $playerId;

        echo json_encode(['success' => true, 'message' => "Welcome, $username!"]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username cannot be empty.']);
}
?>
