<?php

require('./../common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $sql="UPDATE users SET name=:name, status=:status, email=:email, tel=:tel, prefecture=:prefecture, city=:city, birthday=:birthday, sex=:sex, job=:job, tag=:tag, memo=:memo WHERE user_id=:user_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':status', $_POST['status'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(':tel', $_POST['tel'], PDO::PARAM_STR);
    $stmt->bindParam(':prefecture', $_POST['prefecture'], PDO::PARAM_STR);
    $stmt->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
    $stmt->bindParam(':birthday', $_POST['birthday'], PDO::PARAM_STR);
    $stmt->bindParam(':sex', $_POST['sex'], PDO::PARAM_STR);
    $stmt->bindParam(':job', $_POST['job'], PDO::PARAM_STR);
    $stmt->bindParam(':tag', $_POST['tag'], PDO::PARAM_STR);
    $stmt->bindParam(':memo', $_POST['memo'], PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $_POST['user_id'], PDO::PARAM_STR);
    $stmt->execute();
    
} catch(PDOException $e){
    echo $e->getMessage();
}

header('Location: ../users_list.php');
?>