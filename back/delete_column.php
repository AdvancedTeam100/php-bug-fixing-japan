<?php
require('../common.php');

// IDを取得
$id = $_POST['id'];

try {
    $db = new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // コラムを削除
    $stmt = $db->prepare("DELETE FROM columns WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // コラム一覧ページにリダイレクト
    header('Location: ../column_list.php');
    exit;
} catch (PDOException $e) {
    echo '削除に失敗しました。'.$e->getMessage();
    exit;
}
?>
