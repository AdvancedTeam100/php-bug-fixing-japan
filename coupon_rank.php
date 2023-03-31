<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM coupon_used");
    $stmt->execute();
    $coupon_used_data = $stmt->fetchAll();

    $sql = "SELECT user_id, COUNT(*) as count
        FROM coupon_used
        GROUP BY user_id
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
    <h1>クーポン使用度ランキング</h1>
    
    <table class="t">
        <tr>
            <th>順位</th>
            <th>クーポンID</th>
            <th>クーポン名</th>
            <th>件数</th>
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
                                
                try{
                    $stmt = $db->prepare("SELECT * FROM coupons WHERE coupon_id=?");
                    $stmt->execute([$ranking['user_id']]);
                    $coupon_data = $stmt->fetch(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                        echo '接続失敗' . $e->getMessage();
                        exit();
                };

                echo "
                <tr>
                    <td>{$current_rank}位</td>
                    <td>{$coupon_data['coupon_id']}</td>
                    <td>{$coupon_data['name']}</td>
                    <td>{$ranking['count']}回</td>
                </tr>";
            }
            ?>

    </table>
</main>

<?php require('footer.php');?>