<?php
    if(isset($_POST['user_id'])&&isset($_POST['memo'])){
        include('../common.php');
    
        $user_id = $_POST['user_id'];
        $memo = $_POST['memo'];
        date_default_timezone_set('Asia/Tokyo');
        $updated_at = date('Y-m-d H:i:s');
        
        try{
            $db= new PDO($dsn,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $stmt = $db->prepare('UPDATE users SET memo=:memo, updated_at=:updated_at WHERE user_id = :user_id');
            $stmt->execute(array(':user_id' => $user_id,':memo' => $memo,':updated_at' => $updated_at));
        
            $db = null;
        }catch(PDOException $e){
            echo '接続失敗' . $e->getMessage();
            exit();
        };
        
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }
    
    
?>
