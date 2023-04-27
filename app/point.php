<?php require('header.php');?>
<?php
    try {
        $db = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        // ユーザーの保有ポイントを取得
        $query = "SELECT SUM(point) FROM points WHERE user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $points = $stmt->fetchColumn();

        // ユーザーが保有するクーポンを取得
        $query = "SELECT * FROM coupons WHERE coupon_id IN (SELECT coupon_id FROM coupon_user WHERE user_id = :user_id)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 交換可能なクーポンを取得
        $query = "SELECT * FROM coupons WHERE point_cost <= :points AND coupon_id NOT IN (SELECT coupon_id FROM coupon_user WHERE user_id = :user_id)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':points', $points, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $exchangeableCoupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    };
?>
<main>
    <div class="point">
        <h2>保有ポイント</h2>
        <p class="myPoint"><?=$points?> P</p>
    </div>
    <br><br>
    <div class="Mycoupon">
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
        <h2>保有ポイントでお得なクーポンをGET</h2>
        <?php if (count($exchangeableCoupons) > 0): ?>
        <?php foreach ($exchangeableCoupons as $exchangeableCoupon): ?>
            <div class="coupon_card">
                <p><?=$exchangeableCoupon['name']?></p>
                <?=$exchangeableCoupon['description']?>
                <form action="back/buy_coupon.php" method="post" onsubmit="return confirm('本当に<?=$exchangeableCoupon['point_cost']?>ポイントを交換しますか？');">
                    <input type="hidden" name="coupon_id" value="<?=$exchangeableCoupon['coupon_id']?>">
                    <input type="hidden" name="point_cost" value="<?=$exchangeableCoupon['point_cost']?>">
                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                    <button><?=$exchangeableCoupon['point_cost']?>ポイントを交換</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>現在保有中のクーポンはありません。</p>
    <?php endif; ?>

</div>
<br><br>

</main>
<?php require('footer.php');?>
