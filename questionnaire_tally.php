<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM question_items");
    $stmt->execute();
    $question_items_data = $stmt->fetchAll();

    $stmt = $db->prepare("SELECT * FROM answers");
    $stmt->execute();
    $answers_data = $stmt->fetchAll();

    // 各質問の回答の数を数える
// Q1の回答数を数える
$q1_counts = array_count_values(array_column($answers_data, 'q1'));
$q2_counts = array_count_values(array_column($answers_data, 'q2'));
$q3_counts = array_count_values(array_column($answers_data, 'q3'));
$q4_counts = array_count_values(array_column($answers_data, 'q4'));

// はじめて、２回目、３-５回、それ以上、一度もないが存在しない場合は、代替の値を設定する
if (!isset($q1_counts['はじめて'])) {
  $q1_counts['はじめて'] = 0;
}
if (!isset($q1_counts['２回目'])) {
  $q1_counts['２回目'] = 0;
}
if (!isset($q1_counts['３-５回'])) {
  $q1_counts['３-５回'] = 0;
}
if (!isset($q1_counts['それ以上'])) {
  $q1_counts['それ以上'] = 0;
}
if (!isset($q1_counts['一度もない'])) {
  $q1_counts['一度もない'] = 0;
}

// Q2の回答数を数える
$q2_counts = array_count_values(array_column($answers_data, 'q2'));

// 好き、付き合い程度、飲めない、飲まないが存在しない場合は、代替の値を設定する
if (!isset($q2_counts['好き'])) {
  $q2_counts['好き'] = 0;
}
if (!isset($q2_counts['付き合い程度'])) {
  $q2_counts['付き合い程度'] = 0;
}
if (!isset($q2_counts['飲めない'])) {
  $q2_counts['飲めない'] = 0;
}
if (!isset($q2_counts['飲まない'])) {
  $q2_counts['飲まない'] = 0;
}


}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};
?>

<?php require('header.php');?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php require('menu.php');?>
    <main>
      <h1>アンケート集計</h1>
      <table>
        <td>
        <h2>Q1 : <?=$question_items_data[0]['question']?></h2>
      <p>選択肢 : <?=$question_items_data[0]['choices']?></p>
      <div style="width:300px"><canvas id="chart1"></canvas></div>
<script>
    var ctx = document.getElementById("chart1").getContext("2d");
    var chart1 = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["はじめて", "２回目", "３-５回", "それ以上", "一度もない"],
            datasets: [{
                label: "来店回数",
                data: ['<?=$q1_counts['はじめて']?>', '<?=$q1_counts['２回目']?>', '<?=$q1_counts['３-５回']?>', '<?=$q1_counts['それ以上']?>', '<?=$q1_counts['一度もない']?>'],
                backgroundColor: ["#f94144", "#f3722c", "#f8961e", "#f9c74f", "#90be6d"]
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: "Q1: 来店回数"
            }
        }
    });</script>
        </td>

        <td>
        <h2>Q2 : <?=$question_items_data[1]['question']?></h2>
      <p>選択肢 : <?=$question_items_data[1]['choices']?></p>
    <div style="width:300px"><canvas id="chart2"></canvas></div>
  <script>
    var ctx2 = document.getElementById("chart2").getContext("2d");
var chart2 = new Chart(ctx2, {
    type: "pie",
    data: {
        labels: ["好き", "付き合い程度", "飲めない", "飲まない"],
        datasets: [{
            label: "お酒はよく飲みますか？",
            data: ['<?=$q2_counts['好き']?>', '<?=$q2_counts['付き合い程度']?>', '<?=$q2_counts['飲めない']?>', '<?=$q2_counts['飲まない']?>'],
            backgroundColor: ["#f94144", "#f3722c", "#f8961e", "#f9c74f"]
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: "Q2: お酒はよく飲みますか？"
        }
    }
});

</script>
        </td>
      </table>



    </main>


    <?php require('footer.php');?>