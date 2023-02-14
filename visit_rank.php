<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users_data = $stmt->fetchAll();

    $stmt = $db->prepare("SELECT user_id, COUNT(user_id) AS visit_count FROM visits GROUP BY user_id ORDER BY visit_count DESC");
    $stmt->execute();
    $visit_data = $stmt->fetchAll();

    $rank = 1;

}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};



?>

<?php require('header.php');?>
    <?php require('menu.php');?>
<main>
    <h1>来店回数</h1>
    
    <table class="t">
        <tr>
            <th>順位</th>
            <th>名前</th>
            <th>回数</th>
        </tr>
        <?php foreach ($visit_data as $visit){
            $user_id = $visit['user_id'];
            $visit_count = $visit['visit_count'];
            
            $user_stmt = $db->prepare("SELECT name FROM users WHERE user_id = :user_id");
            $user_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $user_stmt->execute();
            $user_data = $user_stmt->fetch();

            echo "<tr>";
            echo "<td>" . $rank . "位</td>";
            echo "<td>" . $user_data['name'] . "</td>";
            echo "<td>" . $visit_count . "回</td>";
            echo "</tr>";
            
            $rank++;}
            ?>

    </table>
</main>

<?php require('footer.php');?>