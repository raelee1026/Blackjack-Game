<!--112550003 李昀祐 第五次作業 12/06 112550003 Yun-Yu, Lee The Fith Homework 12/06 -->
<?php
session_start(); // 啟用 PHP 的 Session 功能，用於存儲用戶狀態
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HW5_112550003_李昀祐</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/script.js"></script>
    </head>

    <body>
        <form id="login-form">
            <label for="username">Enter your name:</label>
            <input type="text" id="username" name="username" required>
            <button type="submit">Login</button>
        </form>
        <div id="login-message"></div>
        <script>
            document.getElementById('login-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const username = document.getElementById('username').value;
                const response = await fetch('php/login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username })
                });
                const result = await response.json();
                document.getElementById('login-message').textContent = result.message;
            });
        </script>


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

    </body>
</html>