<?php require('header.php'); ?>

<main>
  <?php
  // パラメータからidを取得
  $id = isset($_GET['id']) ? (int)$_GET['id'] : '';

  // idが未指定の場合はリダイレクト
  if (!$id) {
    header('Location: column.php');
    exit();
  }

  // データベースから投稿データを取得
  try {
    $db = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM columns WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $column_data = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
  }

  // 投稿が存在しない場合はリダイレクト
  if (!$column_data) {
    header('Location: column.php');
    exit();
  }
  ?>

  <style>

  </style>
<main>
  <div class="column_detail">
    <img src="../<?= $column_data['image_path'] ?>" alt="<?= $column_data['title'] ?>">
    <h1><?= $column_data['title'] ?></h1>
    <div class="column-body"><?= $column_data['body'] ?></div>
    
    <br><br>

    <small>投稿日：<?= date('Y年m月d日', strtotime($column_data['created_at'])) ?></small>
    
    <div class="text-center mt-4">
        <br>
      <a href="column.php" class="btn btn-secondary">戻る</a>
    </div>
  </div>
</main>


<?php require('footer.php'); ?>
