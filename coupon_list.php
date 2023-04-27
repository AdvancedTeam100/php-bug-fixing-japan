<?php
require('common.php');

try{
  $db= new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  $stmt = $db->prepare("SELECT * FROM coupons");
  $stmt->execute();
  $coupons_data = $stmt->fetchAll();
}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

?>
<?php require('header.php');?>
    <?php require('menu.php');?>
    <main>
      <h1>クーポン一覧</h1>
      <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新規登録</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- modal-body -->
                <div class="modal-body" id="modal_req">
                <form action="./back/new_coupon.php" method="post">
                    <table>
                        <tr>
                            <td>クーポン名</td>
                            <td>
                                <input type="text" name="name">
                            </td>
                        </tr>
                        <tr>
                            <td>内容</td>
                            <td>
                                <input type="text" name="description">
                            </td>
                        </tr>
                        <tr>
                            <td>交換ポイント</td>
                            <td>
                                <input type="text" name="point_cost">
                            </td>
                        </tr>
                        <tr>
                            <td>有効期限</td>
                            <td>
                                <input type="date" name="expiration_date">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                </div>
                <div class="modal-footer">
                            <input type="hidden" name="cid" value="<?=$client_id?>">
                            <button type="submit" class="btn btn-secondary">作成</button>
                        </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
        新規作成</button>

    <br><br>
      <div class="content responsive-table">
        <table class="t">
            <tr>
                <th>ID</th>
                <th>クーポン名</th>
                <th>内容</th>
                <th>交換ポイント</th>
                <th>有効期限</th>
                
            </tr>
            <?php foreach($coupons_data as $i => $coupon) :?>
            <tr>
                <td><?=$coupon['coupon_id']?></td>
                <td><?=$coupon['name']?></td>
                <td><?=$coupon['description']?></td>
                <td><?=$coupon['point_cost']?></td>
                <td><?= (new DateTime($coupon['expiration_date']))->format('Y年m月d日') ?></td>
                <td>
                    
                </td>
            </tr>
            <?php endforeach;?>
        </table>

      </div>
    </main>
    <?php require('footer.php');?>