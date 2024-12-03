<?php
session_start();
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

if (!empty($username) && !empty($password)) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 檢查用戶是否存在
        $stmt = $pdo->prepare('SELECT id, password FROM players WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $player = $stmt->fetch();

        if ($player && password_verify($password, $player['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['player_id'] = $player['id'];
            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
}
?>
