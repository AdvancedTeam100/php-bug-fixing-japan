<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT YEAR(CURRENT_TIMESTAMP) - YEAR(birthday) - (DATE_FORMAT(CURRENT_TIMESTAMP, '%m%d') < DATE_FORMAT(birthday, '%m%d')) AS age, sex, COUNT(*) AS count FROM users GROUP BY age DIV 10, sex ORDER BY age DIV 10, sex");
    $stmt->execute();
    $users_data = $stmt->fetchAll();
    
    $age_ranges = array(
        "10代", "20代前半", "20代後半", "30代前半", "30代後半", "40代前半", "40代後半", "50代以上"
    );
    
    $rankings = array();
    foreach ($age_ranges as $age_range) {
        $rankings[$age_range] = array(
            "男性" => 0,
            "女性" => 0
        );
    }
    
    foreach ($users_data as $user) {
        $age_range = $age_ranges[floor($user['age'] / 10)];
        $rankings[$age_range][$user['sex']] = $user['count'];
    }
    
}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};



?>

<?php require('header.php');?>
    <?php require('menu.php');?>
<main>
    <h1>年代・性別</h1>
    
    <table class="t">
        <tr>
            <th>順位</th>
            <th>年代性別</th>
            <th>人数</th>
        </tr>
        <?php
           $ranking_no = 1;
           foreach ($age_ranges as $age_range) {
               foreach (array("女性", "男性") as $gender) {
                   $count = $rankings[$age_range][$gender];
                   if ($count > 0) {
                       echo "<td>{$ranking_no}</td> <td>{$age_range}{$gender}</td> <td>{$count}</td><br>";
                       $ranking_no++;
                   }
               }
           }
            ?>

    </table>
</main>

<?php require('footer.php');?>