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

// Q3の回答数を数える
$q3_counts = array_count_values(array_column($answers_data, 'q3'));

// 週１，２ 回,週 ３-５回,それ以上,あまりしないが存在しない場合は、代替の値を設定する
if (!isset($q3_counts['週１，２ 回'])) {
  $q3_counts['週１，２ 回'] = 0;
}
if (!isset($q3_counts['週 ３-５回'])) {
  $q3_counts['週 ３-５回'] = 0;
}
if (!isset($q3_counts['それ以上'])) {
  $q3_counts['それ以上'] = 0;
}
if (!isset($q3_counts['あまりしない'])) {
  $q3_counts['あまりしない'] = 0;
}

// カンマ区切りの回答を分割してフラット化
$q4_flat_answers = [];
foreach ($answers_data as $answer) {
    $q4_answers = explode(',', $answer['q4']);
    $q4_flat_answers = array_merge($q4_flat_answers, $q4_answers);
}

// Q4の回答数を数える
$q4_counts = array_count_values($q4_flat_answers);

// 職場,先輩後輩,友達,家族,恋人,一人,その他が存在しない場合は、代替の値を設定する
if (!isset($q4_counts['職場'])) {
  $q4_counts['職場'] = 0;
}
if (!isset($q4_counts['先輩後輩'])) {
  $q4_counts['先輩後輩'] = 0;
}
if (!isset($q4_counts['友達'])) {
  $q4_counts['友達'] = 0;
}
if (!isset($q4_counts['家族'])) {
  $q4_counts['家族'] = 0;
}
if (!isset($q4_counts['恋人'])) {
  $q4_counts['恋人'] = 0;
}
if (!isset($q4_counts['一人'])) {
  $q4_counts['一人'] = 0;
}
if (!isset($q4_counts['その他'])) {
  $q4_counts['その他'] = 0;
}

// Q5の回答数を数える
$q5_counts = array_count_values(array_column($answers_data, 'q5'));

// １軒,２軒,３軒,４軒以上が存在しない場合は、代替の値を設定する
if (!isset($q5_counts['１軒'])) {
  $q5_counts['１軒'] = 0;
}
if (!isset($q5_counts['２軒'])) {
  $q5_counts['２軒'] = 0;
}
if (!isset($q5_counts['３軒'])) {
  $q5_counts['３軒'] = 0;
}
if (!isset($q5_counts['４軒以上'])) {
  $q5_counts['４軒以上'] = 0;
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
      <table class="questionnaire_tally">
        <td>
            <h2>Q1 : <?=$question_items_data[0]['question']?></h2>
            <p>選択肢 : <?=$question_items_data[0]['choices']?></p>
            <div style="width:300px"><canvas id="chart1"></canvas></div>
            <script>
                // Q1
                var ctx = document.getElementById("chart1").getContext("2d");
                  var chart1 = new Chart(ctx, {
                      type: "pie",
                      data: {
                          labels: ["はじめて", "２回目", "３-５回", "それ以上", "一度もない"],
                          datasets: [{
                              label: "来店回数",
                              data: [
                                  '<?=$q1_counts['はじめて']?>',
                                  '<?=$q1_counts['２回目']?>',
                                  '<?=$q1_counts['３-５回']?>',
                                  '<?=$q1_counts['それ以上']?>',
                                  '<?=$q1_counts['一度もない']?>'
                              ],
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
          });
            </script>
        </td>

        <td>
            <h2>Q2 : <?=$question_items_data[1]['question']?></h2>
            <p>選択肢 : <?=$question_items_data[1]['choices']?></p>
            <div style="width:300px"><canvas id="chart2"></canvas></div>
          <script>
            // Q2
              var ctx2 = document.getElementById("chart2").getContext("2d");
              var chart2 = new Chart(ctx2, {
                  type: "pie",
                  data: {
                      labels: ["好き", "付き合い程度", "飲めない", "飲まない"],
                      datasets: [{
                          label: "お酒はよく飲みますか？",
                          data: [
                              '<?=$q2_counts['好き']?>',
                              '<?=$q2_counts['付き合い程度']?>',
                              '<?=$q2_counts['飲めない']?>',
                              '<?=$q2_counts['飲まない']?>'
                          ],
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

        <td>
            <h2>Q3 : <?=$question_items_data[2]['question']?></h2>
            <p>選択肢 : <?=$question_items_data[2]['choices']?></p>
            <div style="width:300px"><canvas id="chart3"></canvas></div>
            <script>
                var ctx3 = document.getElementById("chart3").getContext("2d");
                var chart3 = new Chart(ctx3, {
                    type: "pie",
                    data: {
                      labels: ["週１，２ 回", "週 ３-５回", "それ以上", "あまりしない"],
                        datasets: [{
                            label: "外食回数",
                            data: [
                                '<?=$q3_counts['週１，２ 回']?>',
                                '<?=$q3_counts['週 ３-５回']?>',
                                '<?=$q3_counts['それ以上']?>',
                                '<?=$q3_counts['あまりしない']?>'
                            ],
                            backgroundColor: ["#f94144", "#f3722c", "#f8961e", "#f9c74f"]
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: "Q3: 外食回数"
                        }
                    }
                });
            </script>
        </td>
        
        <td>
        <h2>Q4 : <?=$question_items_data[3]['question']?></h2>
        <p>選択肢 : <?=$question_items_data[3]['choices']?></p>
        <div style="width:300px"><canvas id="chart4"></canvas></div>
        <script>
            var ctx4 = document.getElementById("chart4").getContext("2d");
            var chart4 = new Chart(ctx4, {
                type: "pie",
                data: {
                    labels: ["職場", "先輩後輩", "友達", "家族", "恋人", "一人", "その他"],
                    datasets: [{
                        label: "飲みに行くメンバーは？",
                        data: [
                            '<?=$q4_counts['職場']?>',
                            '<?=$q4_counts['先輩後輩']?>',
                            '<?=$q4_counts['友達']?>',
                            '<?=$q4_counts['家族']?>',
                            '<?=$q4_counts['恋人']?>',
                            '<?=$q4_counts['一人']?>',
                            '<?=$q4_counts['その他']?>'
                        ],
                        backgroundColor: ["#f94144", "#f3722c", "#f8961e", "#f9c74f", "#90be6d", "#43aa8b", "#577590"]
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Q4: 飲みに行くメンバーは？"
                    }
                }
            });
        </script>
        </td>

        <td>
            <h2>Q5 : <?=$question_items_data[4]['question']?></h2>
            <p>選択肢 : <?=$question_items_data[4]['choices']?></p>
            <div style="width:300px"><canvas id="chart5"></canvas></div>
            <script>
                var ctx5 = document.getElementById("chart5").getContext("2d");
                var chart5 = new Chart(ctx5, {
                    type: "pie",
                    data: {
                        labels: ["１軒", "２軒", "３軒", "４軒以上"],
                        datasets: [{
                            label: "飲みに行く時は何件くらいハシゴしますか？",
                            data: [
                                '<?=$q5_counts['１軒']?>',
                                '<?=$q5_counts['２軒']?>',
                                '<?=$q5_counts['３軒']?>',
                                '<?=$q5_counts['４軒以上']?>'
                            ],
                            backgroundColor: ["#f94144", "#f3722c", "#f8961e", "#f9c74f"]
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: "Q5: 飲みに行く時は何件くらいハシゴしますか？"
                        }
                    }
                });
            </script>
        </td>


      </table>



    </main>


    <?php require('footer.php');?>