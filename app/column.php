<?php require('header.php');?>

<main>
<?php
// データベースから投稿データを取得
try{
  $db = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  $stmt = $db->prepare("SELECT * FROM columns ORDER BY created_at DESC");
  $stmt->execute();
  $columns_data = $stmt->fetchAll();
}catch(PDOException $e){
  echo '接続失敗' . $e->getMessage();
  exit();
}
?>

  <style>
      .column {
        display: flex;
        margin: 0.5rem 0;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
      }
      .column-image{
        width: 50px;
        margin-right: 0.5rem;
      }
      .column-title {
        font-size: 1.2rem;
      }
      .column-date {
        margin-top: 0.5rem;
        font-size: 0.8rem;
      }
    .column-image {
        width: 85px;
    }
  </style>
</head>
<body>
  <h1>投稿一覧</h1>
  <?php foreach($columns_data as $column_data): ?>
    <div class="column">
      <img src="../<?=$column_data['image_path']?>" alt="<?=$column_data['title']?>" class="column-image">
      <div class="column-content">
        <h2 class="column-title"><?=$column_data['title']?></h2>
        <p class="column-date"><?=$column_data['created_at']?></p>
        <a href="column_detail.php?id=<?=$column_data['id']?>">詳細を見る</a>
      </div>
    </div>
  <?php endforeach; ?>

</main>

<?php require('footer.php');?>
