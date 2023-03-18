<?php

    include('../common.php');

    $name = $_POST['name'];
    $description = $_POST['description'];
    $point_cost = $_POST['point_cost'];
    $expiration_date = $_POST['expiration_date'];

    try{
        $db = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $query = "INSERT INTO coupons (name, description, point_cost, expiration_date) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $point_cost, $expiration_date]);

        $db = null;
    } catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
    };
    
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();

?>
