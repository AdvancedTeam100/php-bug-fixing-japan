<?php
require('common.php');

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM users ORDER BY created_at DESC LIMIT 5");
    $stmt->execute();
    $created_at_user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT * FROM users ORDER BY updated_at DESC LIMIT 5");
    $stmt->execute();
    $updated_at_user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $today = date("Y-m-d");
    $d_val = strtotime("-1 Months");
    $one_month_ago = date("Y-m-d", $d_val);

    $stmt = $db->prepare("SELECT user_id, COUNT(*) as visit_count, DATE(visit_date) as visit_date FROM visits WHERE visit_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() GROUP BY DATE(visit_date) ORDER BY visit_date");
    $stmt->execute();
    $visits_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT * FROM coupon_used ORDER BY used_datetime DESC LIMIT 5");
    $stmt->execute();
    $coupon_used = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}
;

?>
<?php require('header.php'); ?>
<?php require('menu.php'); ?>
<main>
    <h1>dashboard</h1>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    来店回数推移
                </div>
                <div class="card-body">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <div style=""><canvas id="chart1"></canvas></div>

                    <?php
                    $real_date = array();
                    $month_date = array();
                    $i = 0;
                    foreach ($visits_data as $key => $value) {
                        $visit_count[$i] = $value['visit_count'];
                        $visit_date[$i] = $value['visit_date'];
                        $i++;
                    }

                    for ($j = 0; $j < 30; $j++) {
                        $month_date[$j] = Date('Y-m-d', strtotime(-$j . ' days'));
                    }

                    ?>

                    <script>

                        var time_Array = [
                            <?php for ($j = 0; $j < $i; $j++) {
                                echo "'" . $visit_date[$j] . "',";
                            } ?>
                        ];

                        var month_Array = [
                            <?php for ($j = 0; $j < 30; $j++) {
                                echo "'" . $month_date[$j] . "',";
                            } ?>
                        ];

                        var people = [
                            <?php for ($j = 0; $j < $i; $j++) {
                                echo $visit_count[$j] . ",";
                            } ?>
                        ];

                        var real_Array = [];
                        for (let j = 0; j < 30; j++) {
                            real_Array[j] = 0;
                            for (let i = 0; i < <?php echo $i ?>; i++) {
                                if (month_Array[j] == time_Array[i]) {
                                    real_Array[j] = people[i];
                                }
                            }
                        }

                        var ctx = document.getElementById("chart1").getContext("2d");
                        var chart1 = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: month_Array.reverse(),
                                datasets: [{
                                    label: "来店回数推移",
                                    data: real_Array,
                                    backgroundColor: ["#f94144", "#f3722c", "#f8961e", "#f9c74f", "#90be6d"]
                                }]
                            },

                            options: {
                                responsive: true
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                        stepSize: 1
                                    }
                                }]
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    クーポン使用履歴
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>使用したユーザー</th>
                                <th>クーポン名</th>
                                <th>使用日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($coupon_used as $c): ?>
                                <tr>
                                    <td>
                                        <?php
                                        $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
                                        $stmt->execute([$c['user_id']]);
                                        $coupon_used_user = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $coupon_used_user['name'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $stmt = $db->prepare("SELECT * FROM coupons WHERE coupon_id=?");
                                        $stmt->execute([$c['coupon_id']]);
                                        $coupons = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $coupons['name'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo date('Y-m-d H:i', strtotime($c['used_datetime'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    最近追加された会員
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>作成日時</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($created_at_user_data as $u): ?>
                                <tr>
                                    <td>
                                        <?php echo $u['user_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $u['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo date('Y-m-d H:i', strtotime($u['created_at'])); ?>
                                    </td>
                                    <td>
                                        <form action="user_info.php" method="get">
                                            <input type="hidden" name="user_id" value="<?= $u['user_id'] ?>">
                                            <button type="submit" class="btn btn-primary">詳細</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    最近更新されたメモ
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>メモ</th>
                                <th>更新日時</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($updated_at_user_data as $u): ?>
                                <tr>
                                    <td>
                                        <?php echo $u['user_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $u['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $u['memo']; ?>
                                    </td>
                                    <td>
                                        <?php echo date('Y-m-d H:i', strtotime($u['updated_at'])); ?>
                                    </td>
                                    <td>
                                        <form action="user_info.php" method="get">
                                            <input type="hidden" name="user_id" value="<?= $u['user_id'] ?>">
                                            <button type="submit" class="btn btn-primary">詳細</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</main>



<?php require('footer.php'); ?>