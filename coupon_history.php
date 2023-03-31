<?php
require('common.php');

try{
  $db= new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  $stmt = $db->prepare("SELECT * FROM coupon_used");
  $stmt->execute();
  $coupon_used_data = $stmt->fetchAll();
}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

?>
<?php require('header.php');?>
    <?php require('menu.php');?>
    <main>
      <h1>クーポン使用履歴</h1>
      <div class="content">
        <table class="t">
            <tr>
                <th>ユーザーID</th>
                <th>使用者</th>
                <th>クーポンID</th>
                <th>クーポン名</th>
                <th>交換ポイント</th>
                <th>使用日</th>
            </tr>
            <?php foreach(array_reverse($coupon_used_data,true) as $coupon_used) :
                try{
                    $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
                    $stmt->execute([$coupon_used['user_id']]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $db->prepare("SELECT * FROM coupons WHERE coupon_id=?");
                    $stmt->execute([$coupon_used['coupon_id']]);
                    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                        echo '接続失敗' . $e->getMessage();
                        exit();
                };
                
                ?>
            <tr>
                <td><?=$user['user_id']?></td>
                <td><?=$user['name']?></td>
                <td><?=$coupon_used['coupon_id']?></td>
                <td><?=$coupon['name']?></td>
                <td><?=$coupon['point_cost']?></td>
                <td><?= (new DateTime($coupon_used['used_datetime']))->format('Y年m月d日') ?></td>
                <td>
                    
                </td>
            </tr>
            <?php endforeach;?>
        </table>

      </div>
    </main>
    <?php require('footer.php');?>