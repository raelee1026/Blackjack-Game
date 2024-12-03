<?php
session_start();
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'] ?? '';
$password = $input['password'] ?? ''; // 新增接收密碼

if (!empty($username) && !empty($password)) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 檢查用戶是否已存在
        $stmt = $pdo->prepare('SELECT id FROM players WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $player = $stmt->fetch();

        if ($player) {
            echo json_encode(['success' => false, 'message' => 'Username already exists']);
        } else {
            // 加密密碼
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // 新增用戶，並設置初始籌碼（500）
            $stmt = $pdo->prepare('INSERT INTO players (username, password, chips) VALUES (:username, :password, 500)');
            $stmt->execute([
                'username' => $username,
                'password' => $hashedPassword
            ]);
            echo json_encode(['success' => true, 'message' => 'Registration successful']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
}
?>
