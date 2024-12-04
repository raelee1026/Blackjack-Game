<?php
// 112550003 李昀祐 第五次作業 11/17 112550003 Yun-Yu, Lee The Fifth Homework 11/17 
session_start();

// 检查是否已登录
if (!isset($_SESSION['player_id'])) {
    header('Location: login.php');
    exit;
}

// 假設用戶名稱已存儲在 $_SESSION['username']
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // 如果未登入，跳轉到登入頁
    exit;
}
$username = $_SESSION['username']; // 取得用戶名稱

// 初始化變數
$chipBalance = 0; // 預設值，如果資料庫也沒有資料則設為 0
$cookieData = null;

// 動態生成包含 player_id 的 Cookie 名稱
if (isset($_SESSION['player_id'])) {
    $player_id = $_SESSION['player_id'];
    $cookieName = 'blackjack_data_' . $player_id;

    // 從資料庫中查詢玩家的籌碼值
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT chips FROM players WHERE id = :player_id');
        $stmt->execute([':player_id' => $player_id]);
        $chipBalance = $stmt->fetchColumn();

        if ($chipBalance <= 0) {
            header('Location: php/auth/endgame.php');
            exit;
        }

        // 如果資料庫中沒有找到記錄，設置一個初始值
        if ($chipBalance === false) {
            $chipBalance = 500; // 預設的籌碼值
        }

    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }

    // 從 Cookie 獲取玩家籌碼資料並驗證 player_id
    if (isset($_COOKIE[$cookieName])) {
        $cookieData = json_decode($_COOKIE[$cookieName], true);
        if (isset($cookieData['chips'], $cookieData['player_id']) && $cookieData['player_id'] === $player_id) {
            $chipBalance = $cookieData['chips']; // 如果 Cookie 有效，覆蓋資料庫的值
        } else {
            // 如果 ID 不匹配，清除對應的 Cookie 或其他處理
            setcookie($cookieName, '', time() - 3600, '/'); // 刪除對應的 Cookie
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>HW5_112550003_李昀祐</title>
</head>
<body>
    <div id="game-board">
        <p>Welcome, <span id="username"><?php echo htmlspecialchars($username); ?></span>!</p>
        <a href="php/auth/logout.php">Logout</a>
        <!-- original HTML -->
        <div id="center-message" class="center-message hidden"></div>
        <div id="center-message-alert" class="center-message-alert hidden"></div>
        

        <div id="chip-controls">
            <p id="chip-balance-text">Chips: <span id="chip-balance">500</span></p>
    
            <div class="current-bet-container">
                <p class="current-bet">Current Bet: <span id="current-bet">0</span></p>
                <img src="images/pile-chip.png" alt="pile">
            </div>

            <div class="chip-container">
                <div class="chip" data-value="5">
                    <img src="images/5-chip.png" alt="5 Chip">
                </div>
                <div class="chip" data-value="10">
                    <img src="images/10-chip.png" alt="10 Chip">
                </div>
                <div class="chip" data-value="50">
                    <img src="images/50-chip.png" alt="50 Chip">
                </div>
                <div class="chip" data-value="100">
                    <img src="images/100-chip.png" alt="100 Chip">
                </div>
            </div>
            
            <button class="start-game" id="start-game">Start Game</button>
        </div>
        
        <div id="game-controls">
            <h2>Dealer: <span id="dealer-sum"></span></h2>
            <div id="dealer-cards">
                <img id="hidden" src="./images/card_back.png">
            </div>
    
            <h2>You: <span id="your-sum"></span></h2>
            <div id="your-cards"></div>
    
            <br>
            <button id="hit">Hit</button>
            <button id="stand">Stand</button>
            <p id="results"></p>
        </div>
        
        <div id="history-container"></div>
    </div>

    <script>
        let chipBalance = <?php echo json_encode($chipBalance); ?>;
        // const cookieData = <?php echo json_encode($cookieData); ?>;
        console.log("Chip Balance:", chipBalance);
        // console.log("Cookie Data:", cookieData);
    </script>

    <script src="js/game.js"></script>
</body>
</html>
