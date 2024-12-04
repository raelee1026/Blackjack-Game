<?php
// 112550003 李昀祐 第五次作業 12/06 112550003 Yun-Yu, Lee The Fith Homework 12/06
session_start();

// 检查是否已登录
if (!isset($_SESSION['player_id'])) {
    header('Location: login.php');
    exit;
}

$player_id = $_SESSION['player_id']; // 获取当前玩家的 ID

// 连接数据库
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 获取玩家的所有游戏记录
    $stmt = $pdo->prepare('SELECT * FROM game_results WHERE player_id = :player_id');
    $stmt->execute([':player_id' => $player_id]);
    $gameResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW5_112550003_李昀祐</title>
    <link rel="stylesheet" href="../../css/endgame.css"> <!-- 你可以根据需要加入 CSS 文件 -->
</head>
<body>
    <h1>Game Results</h1>

    <?php if (empty($gameResults)): ?>
        <p>No game results found.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Round</th>
                    <th>Player Card Count</th>
                    <th>Player Points</th>
                    <th>Player Cards</th>
                    <th>Dealer Card Count</th>
                    <th>Dealer Points</th>
                    <th>Dealer Cards</th>
                    <th>Remaining Chips</th>
                    <th>Current Bet</th>
                    <th>Result</th>
                    <th>Timestamp</th>
                    <th>Chips after round</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gameResults as $index => $result): ?>
                    <?php
                        // 解析 JSON 数据
                        $gameData = json_decode($result['game_data'], true);
                        $player = $gameData['player'];
                        $dealer = $gameData['dealer'];
                        $timestamp = $gameData['timestamp']; 
                        $formattedTimestamp = date('Y-m-d H:i:s', strtotime($timestamp));
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td> 
                        <td><?php echo $player['cardCount']; ?></td> 
                        <td><?php echo $player['sum']; ?></td> 
                        <td><?php echo implode(", ", $player['cardValues']); ?></td>
                        <td><?php echo $dealer['cardCount']; ?></td> 
                        <td><?php echo $dealer['sum']; ?></td> 
                        <td><?php echo implode(", ", $dealer['cardValues']); ?></td> 
                        <td><?php echo $gameData['chips']; ?></td> 
                        <td><?php echo $gameData['currentBet']; ?></td> 
                        <td><?php echo $gameData['result']; ?></td> 
                        <td><?php echo $formattedTimestamp; ?></td>
                        <td><?php echo intval($result['chips']); ?></td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br><br>
    <button class="logout-btn" onclick="window.location.href='logout.php';">Logout</button>
</body>
</html>
