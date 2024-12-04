<!--112550003 李昀祐 第五次作業 12/06 112550003 Yun-Yu, Lee The Fith Homework 12/06 -->
<?php
session_start();

// 如果用戶已登入，跳轉到遊戲頁面
if (isset($_SESSION['username'])) {
    header('Location: game.php');
    exit;
}

$message = ''; // 用於顯示錯誤或成功訊息

// 登入邏輯
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('SELECT id, password FROM players WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $player = $stmt->fetch();

            if ($player && password_verify($password, $player['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['player_id'] = $player['id'];
                $_SESSION['chipBalance'] = $player['chips'];
                header('Location: game.php');
                exit;
            } else {
                $message = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            $message = 'Database error: ' . $e->getMessage();
        }
    } else {
        $message = 'Please enter both username and password.';
    }
}

// 註冊邏輯
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('SELECT id FROM players WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $player = $stmt->fetch();

            if ($player) {
                $message = 'Username already exists.';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO players (username, password, chips) VALUES (:username, :password, 500)');
                $stmt->execute([
                    'username' => $username,
                    'password' => $hashedPassword
                ]);
                $message = 'Registration successful. You can now log in.';
            }
        } catch (PDOException $e) {
            $message = 'Database error: ' . $e->getMessage();
        }
    } else {
        $message = 'Please enter both username and password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/auth2.css">
    <title>Login/Register</title>
</head>
<body>
    
    <div class="form-container">
        <!-- <h1>blackjack</h1> -->
        <div class="form-section">
            <h2>Login</h2>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
        <div class="form-section">
            <h2>Register</h2>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>

    </div>
    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>
