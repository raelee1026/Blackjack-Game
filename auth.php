<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: game.php'); // 如果已登入，跳轉到遊戲頁面
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/auth.js"></script>
    <title>Login/Register</title>
    <style>
        /* 彈窗樣式 */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        .modal-content input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
        }
        .modal-content button {
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <h1>Welcome to Blackjack</h1>
    <button id="login-btn">Login</button>
    <button id="register-btn">Register</button>

    <!-- Login Modal -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <h2>Login</h2>
            <input type="text" id="login-username" placeholder="Username" required>
            <input type="password" id="login-password" placeholder="Password" required>
            <button id="login-submit">Login</button>
            <button onclick="closeModal('login-modal')">Cancel</button>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <h2>Register</h2>
            <input type="text" id="register-username" placeholder="Username" required>
            <input type="password" id="register-password" placeholder="Password" required>
            <button id="register-submit">Register</button>
            <button onclick="closeModal('register-modal')">Cancel</button>
        </div>
    </div>

    <script src="js/auth.js"></script>
    <script>
        // 開啟彈窗
        document.getElementById('login-btn').addEventListener('click', () => openModal('login-modal'));
        document.getElementById('register-btn').addEventListener('click', () => openModal('register-modal'));

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
        // 處理 Login 提交
            document.getElementById('login-submit').addEventListener('click', async () => {
                const username = document.getElementById('login-username').value;
                const password = document.getElementById('login-password').value;

                if (!username || !password) {
                    alert("Please enter both username and password.");
                    return;
                }

                try {
                    const response = await fetch('php/auth/login.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username, password })
                    });
                    const result = await response.json();
                    alert(result.message);

                    if (result.success) {
                        window.location.href = 'game.php'; // 跳轉到遊戲頁面
                    }
                } catch (error) {
                    console.error("Login error:", error);
                }
            });

            // 處理 Register 提交
            document.getElementById('register-submit').addEventListener('click', async () => {
                const username = document.getElementById('register-username').value;
                const password = document.getElementById('register-password').value;

                if (!username || !password) {
                    alert("Please enter both username and password.");
                    return;
                }

                try {
                    const response = await fetch('php/auth/register.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username, password })
                    });
                    const result = await response.json();
                    alert(result.message);

                    if (result.success) {
                        closeModal('register-modal');
                    }
                } catch (error) {
                    console.error("Register error:", error);
                }
            });
        });

    </script>
</body>
</html>
