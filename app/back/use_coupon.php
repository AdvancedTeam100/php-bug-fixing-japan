<?php
require('../../common.php');

// POSTされたデータを取得する
$coupon_id = $_POST['coupon_id'];
$user_id = $_POST['user_id'];

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // coupon_usedテーブルにレコードを挿入する
    $query = "INSERT INTO coupon_used (user_id, coupon_id, used_datetime, used_place) VALUES (:user_id, :coupon_id, NOW(), 'Web')";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':coupon_id', $coupon_id, PDO::PARAM_INT);
    $stmt->execute();

    // coupon_userからレコードを削除する
    $query = "DELETE FROM coupon_user WHERE user_id = :user_id AND coupon_id = :coupon_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':coupon_id', $coupon_id, PDO::PARAM_INT);
    $stmt->execute();

} catch (Exception $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}

// DB接続を閉じる
$db = null;

header('Location: ./../point.php');
exit();
?>
