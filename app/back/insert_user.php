<?php
require('../../common.php');

// POSTされたフォームデータを取得
$name = $_POST['name'];
$email = $_POST['email'];
$prefecture = $_POST['prefecture'];
$city = $_POST['city'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$occupation = $_POST['occupation'];
$phone = $_POST['phone'];
$answers = $_POST; // アンケートの回答をすべて受け取る

try {
    // データベースに接続
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // ユーザ情報をusersテーブルに登録
    $stmt = $db->prepare('INSERT INTO users (name, email, prefecture, city, birthday, sex, job, tel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $prefecture, PDO::PARAM_STR);
    $stmt->bindValue(4, $city, PDO::PARAM_STR);
    $stmt->bindValue(5, $birthdate, PDO::PARAM_STR);
    $stmt->bindValue(6, $gender, PDO::PARAM_STR);
    $stmt->bindValue(7, $occupation, PDO::PARAM_STR);
    $stmt->bindValue(8, $phone, PDO::PARAM_STR);
    $stmt->execute();

    // 登録したユーザIDを取得
    $user_id = $db->lastInsertId();

    // アンケート回答をanswersテーブルに登録
    $answer_values = [];
    $answer_values[] = $user_id;
    foreach ($answers['question_item_id'] as $key => $value) {
            $answer_values[] = $value;
    }
    $stmt = $db->prepare('INSERT INTO answers (user_id, q1, q2, q3, q4, q5) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute($answer_values);

    // データベース接続を切断
    $db = null;

    header('Location: ./../thanks.php');
    exit();
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}
