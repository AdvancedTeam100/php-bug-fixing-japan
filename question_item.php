<?php
require('common.php');

try{
  $db= new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  $stmt = $db->prepare("SELECT * FROM question_items");
  $stmt->execute();
  $question_items_data = $stmt->fetchAll();
}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

?>
<?php require('header.php');?>
    <?php require('menu.php');?>
    <main>
      <h1>アンケート内容</h1>
      <div class="content">
        <table class="t">
            <tr>
                <th></th>
                <th>項目</th>
                <th>選択肢</th>
            </tr>
            <?php foreach($question_items_data as $i => $question_item) :?>
            <tr>
                <td>Q<?=$i+1?>.</td>
                <td><?=$question_item['question']?></td>
                <td><?=$question_item['choices']?></td>
            </tr>
            <?php endforeach;?>
        </table>

      </div>
    </main>
    <?php require('footer.php');?>