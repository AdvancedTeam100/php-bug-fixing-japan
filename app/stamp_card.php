
<?php require('header.php');?>
<?php

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $query = "SELECT COUNT(*) FROM visits WHERE user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

if($count>40){
    $stamp_count = 40;
}else{
    $stamp_count = $count;
}
?>
<main>
    <h1>スタンプカード</h1>
    <p>来店時にスタッフにQRコードを見せてスタンプを貯めよう！</p>
    <div class="stamp">
        <table>
            <?php
            for($i=0; $i<40; $i++){
                if($i<$stamp_count)
                    echo '<td><img src="img/stamp.png"></td>';
                else if($i+1 == 12)
                    echo '<td>シルバー</td>';
                else if($i+1 == 24)
                    echo '<td>ゴールド</td>';
                else if($i+1 == 40)
                    echo '<td>プラチナ</td>';
                else
                    echo '<td></td>';
            }
            ?>
        </table>
    </div>
</div>

</main>

<?php require('footer.php');?>