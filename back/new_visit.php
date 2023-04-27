<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user_id = $data['user_id'];

    require('../common.php');
    try {
        $db = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $stmt = $db->prepare("INSERT INTO visits (user_id) VALUES (?)");
        $stmt->execute([$user_id]);

        $query = "SELECT COUNT(*) FROM visits WHERE user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->execute([$user_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'data' => [
                'name' => $data['name'],
                'count' => $count
            ]
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'error' => '接続失敗: ' . $e->getMessage()
        ]);
    }
}
?>
