<?php require('header.php');?>
<?php
    try {
        $db = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $stmt = $db->prepare("SELECT * FROM coupon_used WHERE user_id=?");
        $stmt->execute([$user_id]);
        $coupon_used_data = $stmt->fetchAll();

        // ユーザーが保有するクーポンを取得
        $query = "SELECT * FROM coupons WHERE coupon_id IN (SELECT coupon_id FROM coupon_user WHERE user_id = :user_id)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch(PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    };
?>
<main>
    <h1>クーポン履歴</h1>
    
    <div class="coupon_history">
        <h2>現在保有中のクーポン</h2>
        <?php if (count($coupons) > 0): ?>
            <?php foreach ($coupons as $coupon): ?>
                <div class="Mycoupon_card_back">
                    <p><?=$coupon['name']?></p>
                </div>
                    <div class="Mycoupon_card">
                    <p><?=$coupon['description']?></p>
                    <form action="back/use_coupon.php" method="post" onsubmit="return confirm('本当にクーポンを使用しますか？');">
                        <input type="hidden" name="coupon_id" value="<?=$coupon['coupon_id']?>">
                        <input type="hidden" name="user_id" value="<?=$user_id?>">
                        <button>使用する</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>現在保有中のクーポンはありません。</p>
        <?php endif; ?>
    </div>
    <br><br>
    <div class="coupon_list">
        <h2>クーポン履歴</h2>
        <table class="table">
            <tr>
                <th>クーポン名</th>
                <th>使用日</th>
            </tr>
        <?php if (count($coupon_used_data) > 0): ?>
        <?php
        foreach ($coupon_used_data as $used): 
            $stmt = $db->prepare("SELECT * FROM coupons WHERE coupon_id=?");
            $stmt->execute([$used['coupon_id']]);
            $c = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
            <tr>
                <td><?=$c['name']?></td>
                <td><?=$used['used_datetime']?></td>
            </tr>
            
        <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>クーポン履歴はありません。</p>
    <?php endif; ?>

</div>
<br><br>

</main>
<?php require('footer.php');?>
