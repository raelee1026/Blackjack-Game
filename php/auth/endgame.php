<?php
session_start();

// 检查玩家是否已登录
if (!isset($_SESSION['player_id'])) {
    // 如果未登录，重定向到登录页面
    header('Location: auth.php');
    exit;
}

// 处理登出请求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // 清除会话数据
    session_unset();
    session_destroy();

    // 重定向到登录页面
    header('Location: ../../auth.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>游戏结束</title>
    <link rel="stylesheet" href="../../css/auth.css">
</head>
<body>
    <div class="container">
        <h1>游戏结束</h1>
        <p>您的筹码余额已为零，游戏已结束。</p>
        <form method="post">
            <button type="submit" name="logout">登出</button>
        </form>
    </div>
</body>
</html>
