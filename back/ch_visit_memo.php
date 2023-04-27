<?php
    if(isset($_POST['visit_id'])&&isset($_POST['memo'])){
        include('../common.php');
    
        $visit_id = $_POST['visit_id'];
        $memo = $_POST['memo'];
    
        try{
            $db= new PDO($dsn,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $stmt = $db->prepare('UPDATE visits SET memo=:memo WHERE visit_id = :visit_id');
            $stmt->execute(array(':visit_id' => $visit_id,':memo' => $memo));
        
            $db = null;
        }catch(PDOException $e){
            echo '接続失敗' . $e->getMessage();
            exit();
        };
        
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }
    
    
?>
