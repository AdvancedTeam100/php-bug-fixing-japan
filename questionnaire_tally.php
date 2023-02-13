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

}catch(PDOException $e){
      echo '接続失敗' . $e->getMessage();
      exit();
};

?>
<?php require('header.php');?>

    <?php require('menu.php');?>
    <main>
      <h1>アンケート集計</h1>
      <div class="content">
      <canvas id="pieChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

      </div>
    </main>
    <script>
  var questionData = <?php echo json_encode($question_items_data); ?>;
  var answersData = <?php echo json_encode($answers_data); ?>;

  for (var i = 0; i < questionData.length; i++) {
    var question = questionData[i];
    var choices = question['choices'].split(',');
    var results = {};
    for (var j = 0; j < choices.length; j++) {
      results[choices[j]] = 0;
    }
    for (var j = 0; j < answersData.length; j++) {
      var answer = answersData[j]['q' + (i + 1)];
      results[answer]++;
    }
  }

  var chartData = [];
  for (var key in results) {
    chartData.push({
      label: key,
      data: results[key]
    });
  }

  var canvas = document.getElementById("pieChart");

  var data = [];
  var question = questionData[0];
  var choices = question['choices'].split(',');
  var results = {};
  for (var j = 0; j < choices.length; j++) {
    results[choices[j]] = 0;
  }
  for (var j = 0; j < answersData.length; j++) {
    var answer = answersData[j]['q1'];
    results[answer]++;
  }

  for (var choice in results) {
    data.push({
      label: choice,
      data: results[choice]
    });
  }

  var options = {
    responsive: true,
    maintainAspectRatio: false
  };

  var pieChart = new Chart(canvas, {
    type: 'pie',
    data: {
      datasets: [{
        data: data,
        backgroundColor: [
          "#FF6384",
          "#36A2EB",
          "#FFCE56",
          "#4BC0C0",
          "#E7E9ED"
        ]
      }],
      labels: choices
    },
    options: options
  });
</script>


    <?php require('footer.php');?>