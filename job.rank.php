<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users_data = $stmt->fetchAll();

    $sql = "SELECT job, COUNT(*) as count
        FROM users
        GROUP BY prefecture, job
        ORDER BY count DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rankings = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};



?>

<?php require('header.php');?>
    <?php require('menu.php');?>
<main>
    <h1>職業</h1>
    
    <table class="t">
        <tr>
            <th>順位</th>
            <th>職業</th>
            <th>人数</th>
        </tr>
        <?php
            $rank = 1;
            $prev_count = null;
            foreach ($rankings as $index => $ranking) {
                // 件数が前回と同じ場合は、前回の順位をそのまま使う
                if ($ranking['count'] === $prev_count) {
                    $current_rank = $rank;
                } else {
                    $current_rank = $index + 1;
                    $rank = $current_rank;
                    $prev_count = $ranking['count'];
                }
                echo "
                <tr>
                    <td>{$current_rank}位</td>
                    <td>{$ranking['job']}</td>
                    <td>{$ranking['count']}人</td>
                </tr>";
            }
            ?>

    </table>
</main>

<?php require('footer.php');?>