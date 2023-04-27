<?php
include('./../../common.php');

$coupon_id = $_POST['coupon_id'];
$point_cost = $_POST['point_cost'];
$user_id = $_POST['user_id'];

$db = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// ユーザーの所持ポイントからポイントコストを引く
$query = "SELECT SUM(point) FROM points WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$points = $stmt->fetchColumn();

$stmt = $db->prepare('UPDATE points SET point=:point WHERE user_id = :user_id');
$stmt->execute(array(':user_id' => $user_id,':point' => $points-$point_cost));

// coupon_userテーブルにクーポン情報を追加
$stmt = $db->prepare('INSERT INTO coupon_user (user_id, coupon_id) VALUES (:user_id, :coupon_id)');
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':coupon_id', $coupon_id, PDO::PARAM_INT);
$stmt->execute();

// coupon_usedテーブルに使用履歴を追加
$stmt = $db->prepare('INSERT INTO coupon_used (user_id, coupon_id, used_datetime) VALUES (:user_id, :coupon_id, :used_datetime)');
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':coupon_id', $coupon_id, PDO::PARAM_INT);
$used_datetime = date('Y-m-d H:i:s');
$stmt->bindParam(':used_datetime', $used_datetime, PDO::PARAM_STR);
$stmt->execute();

$db = null;

header('Location: '.$_SERVER['HTTP_REFERER']);
exit();
?>