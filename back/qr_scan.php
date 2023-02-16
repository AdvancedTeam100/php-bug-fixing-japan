<?php
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    require('../common.php');
    try {
        $db= new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->execute([$user_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "SELECT COUNT(*) FROM visits WHERE user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    }
}

?>

<script>
    function getPassword() {
        return prompt("パスワードを入力してください:");
    }
    var userPassword = getPassword();

    if (userPassword === "tonton") {
        var postData = {
    "user_id": <?=$_GET['user_id']?>
};
          
var xhr = new XMLHttpRequest();
xhr.open("POST", "new_visit.php", true);
xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
            var data = response.data;
            var message = data.name + "様 の来店履歴を追加しました。<br>累計ご来店回数： " + data.count + "回";
            document.body.innerHTML = message;
        } else {
            alert("エラーが発生しました。");
        }
    }
};

xhr.send(JSON.stringify(postData));


    } else {
        alert("パスワードが正しくありません。");
        location.reload();
    }
</script>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>来店履歴追加</title>
</head>
<body>
    <div id="result">
        <?=$data['name']?>様 の来店履歴を追加しました。<br>
        累計ご来店回数：　<?=$count+1?>回
    </div>
</body>
</html>
