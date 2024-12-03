<?php
session_start();

// 获取前端发送的 JSON 数据
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($_SESSION['player_id']) && $data) {
    $player_id = $_SESSION['player_id'];
    $game_data = json_encode($data);
    //count chips
    $chips = $data['chips'];
    $currentBet = $data['currentBet'];
    $result = $data['result'];

    if ($result === "You Win!") {
        $chips += $currentBet * 2;
    } elseif ($result === "Tie!") {
        $chips += $currentBet;
    } 

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blackjack', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 开始事务
        $pdo->beginTransaction();

        // 插入游戏结果
        $stmt = $pdo->prepare('INSERT INTO game_results (player_id, game_data, chips) VALUES (:player_id, :game_data, :chips)');
        $stmt->execute([
            ':player_id' => $player_id,
            ':game_data' => $game_data,
            ':chips' => $chips
        ]);

        // 更新玩家的筹码数
        $stmt = $pdo->prepare('UPDATE players SET chips = :chips WHERE id = :player_id');
        $stmt->execute([
            ':chips' => $chips,
            ':player_id' => $player_id
        ]);

        // 提交事务
        $pdo->commit();

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        // 回滚事务
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data or session']);
}
?>
