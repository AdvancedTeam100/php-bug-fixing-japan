<?php
require('common.php');

try{
  $db= new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  $stmt = $db->prepare("SELECT * FROM columns");
  $stmt->execute();
  $columns_data = $stmt->fetchAll();
}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

?>
<?php require('header.php');?>
    <?php require('menu.php');?>
    <main>
  <h1>コラム一覧</h1>
  <div class="content">

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newColumnModal">新規投稿</button>
    <br><br>
    <!-- 新規投稿モーダル -->
    <div class="modal fade" id="newColumnModal" tabindex="-1" role="dialog" aria-labelledby="newColumnModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newColumnModalLabel">新規投稿</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="back/post_column.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">タイトル:</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
              <div class="form-group">
                <label for="body">本文:</label>
                <textarea class="form-control" id="body" name="body" rows="8"></textarea>
              </div>
              <div class="form-group">
                <label for="image">画像:</label>
                <input type="file" id="image" name="image">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary">投稿する</button>
          </div>
            </form>
        </div>
      </div>
    </div>

        <table class="t">
            <tr>
                <th>画像</th>
                <th>タイトル</th>
                <th>投稿日</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach(array_reverse($columns_data,true) as $column_data) : ?>
            <tr>
                <td><img src="<?=$column_data['image_path']?>" class="img-thumbnail" style="height: 150px; width: 150px;"></td>
                <td><?=$column_data['title']?></td>
                <td><?=$column_data['created_at']?></td>
                <td>
                    <!-- 詳細ボタン -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?=$column_data['id']?>">詳細</button>
                    <!-- モーダル -->
                    <div class="modal fade" id="myModal<?=$column_data['id']?>" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?=$column_data['title']?></h4>
                                </div>
                                <div class="modal-body">
                                    <p><?=$column_data['body']?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <!-- 削除ボタン -->
                    <form action="back/delete_column.php" method="POST">
                        <input type="hidden" name="id" value="<?=$column_data['id']?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </td>
            </tr>
            <?php endforeach;?>
        </table>

      </div>
    </main>
    <?php require('footer.php');?>

