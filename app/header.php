<?php
require('../common.php');
$user_id = 1;

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->execute([$user_id]);
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};



?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeeHat会員アプリ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="./"><h1>FeeHat App</h1></a>
</header>