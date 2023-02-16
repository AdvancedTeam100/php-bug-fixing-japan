<?php require('header.php');?>
<?php
    try{
        $db= new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $query = "SELECT SUM(point) FROM points WHERE user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $points = $stmt->fetchColumn();

    }catch(PDOException $e){
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
        <div class="Mycoupon_card">
            <p>お会計10％PFFクーポン</p>
            <form action="" method="post">
                <input type="hidden" name="coupon" value="">
                <button>使用する</button>
            </form>
        </div>
        <div class="Mycoupon_card">
            <p>お会計10％PFFクーポン</p>
            <form action="" method="post">
                <input type="hidden" name="coupon" value="">
                <button>使用する</button>
            </form>
        </div>
    </div>
    <br><br>
    <div class="coupon_list">
        <h2>保有ポイントでお得なクーポンをGET</h2>
        <div class="coupon_card">
            <p>お会計10％PFFクーポン</p>
            お会計から10％お値引きできるクーポンです。
            <form action="" method="post">
                <input type="hidden" name="coupon" value="">
                <button>ポイントを交換</button>
            </form>
        </div>
    </div>

</main>

<?php require('footer.php');?>