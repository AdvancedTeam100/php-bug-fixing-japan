<?php
require('./../common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $sql = "SELECT question, choices, COUNT(*) FROM question_items JOIN answers ON answers.question_id = question_items.id GROUP BY question, choices";
    $result = $db->query($sql);

    // 結果を配列に格納
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // JSON形式で出力
    header('Content-Type: application/json');
    echo json_encode($data);

  
}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

?>