<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: auth.php'); // 未登入則跳轉到登入頁面
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/game.js"></script>
    <title>HW5_112550003_李昀祐</title>
</head>
<body>
    <!-- <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1> -->
    
    <div id="game-board">
        <a href="php/auth/logout.php">Logout</a>
        <!-- 原本的遊戲 HTML -->
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
    
</body>
</html>
