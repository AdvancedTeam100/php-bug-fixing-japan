<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <title>入力フォーム</title>
</head>
<body>
    <header>
        <h1>新規登録フォーム</h1>
        <p>下記をご記入ください。</p>
    </header>
    <form action="" method="post">

    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">メールアドレス:</label>
    <input type="email" id="email" name="email" required>

    <label for="prefecture">都道府県:</label>
    <select id="prefecture" name="prefecture" required>
        <option value="山口県">山口県</option>
        <option value="北海道">北海道</option>
        <option value="青森県">青森県</option>
        <option value="岩手県">岩手県</option>
        <option value="宮城県">宮城県</option>
        <option value="秋田県">秋田県</option>
        <option value="山形県">山形県</option>
        <option value="福島県">福島県</option>
        <option value="茨城県">茨城県</option>
        <option value="栃木県">栃木県</option>
        <option value="群馬県">群馬県</option>
        <option value="埼玉県">埼玉県</option>
        <option value="千葉県">千葉県</option>
        <option value="東京都">東京都</option>
        <option value="神奈川県">神奈川県</option>
        <option value="新潟県">新潟県</option>
        <option value="富山県">富山県</option>
        <option value="石川県">石川県</option>
        <option value="福井県">福井県</option>
        <option value="山梨県">山梨県</option>
        <option value="長野県">長野県</option>
        <option value="岐阜県">岐阜県</option>
        <option value="静岡県">静岡県</option>
        <option value="愛知県">愛知県</option>
        <option value="三重県">三重県</option>
        <option value="滋賀県">滋賀県</option>
        <option value="京都府">京都府</option>
        <option value="大阪府">大阪府</option>
        <option value="兵庫県">兵庫県</option>
        <option value="奈良県">奈良県</option>
        <option value="和歌山県">和歌山県</option>
        <option value="鳥取県">鳥取県</option>
        <option value="島根県">島根県</option>
        <option value="岡山県">岡山県</option>
        <option value="広島県">広島県</option>
        <option value="山口県">山口県</option>
        <option value="徳島県">徳島県</option>
        <option value="香川県">香川県</option>
        <option value="愛媛県">愛媛県</option>
        <option value="高知県">高知県</option>
        <option value="福岡県">福岡県</option>
        <option value="佐賀県">佐賀県</option>
        <option value="長崎県">長崎県</option>
        <option value="熊本県">熊本県</option>
        <option value="大分県">大分県</option>
        <option value="宮崎県">宮崎県</option>
        <option value="鹿児島件">鹿児島県</option>
        <option value="沖縄県">沖縄県</option>

    </select>

    <label for="city">市町村:</label>
    <input type="text" id="city" name="city" required>

    <label for="birthdate">生年月日:</label>
    <input type="date" id="birthdate" name="birthdate" required>

    <label>性別:</label>
    <div class="radio-group">
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">男性</label>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">女性</label>
      <input type="radio" id="other" name="gender" value="other">
      <label for="other">その他</label>
    </div>

    <label for="occupation">職業:</label>
    <input type="text" id="occupation" name="occupation">

    <label for="phone">電話番号:</label>
    <input type="tel" id="phone" name="phone">

    <br><br>
    <h2>アンケート</h2>

    <?php
        require('../common.php');
        try{
            $db= new PDO($dsn,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $sql = 'SELECT * FROM question_items';
            $stmt = $db->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
                echo '接続失敗' . $e->getMessage();
                exit();
        };

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $question = $row['question'];
            $choices = $row['choices'];
        ?>
            <label for="q<?= $id ?>"><?= $id ?>. <?= $question ?></label>
            <select id="q<?= $id ?>" name="q<?= $id ?>" required>
                <option value="">選択してください</option>
                <?php
                $choice_array = explode(',', $choices);
                foreach ($choice_array as $choice) {
                ?>
                    <option value="<?= $choice ?>"><?= $choice ?></option>
                <?php
                }
                ?>
            </select>
            <br>
        <?php
        }
        $db = null;
        ?>

    <input type="submit" value="送信">
    </form>

</body>
</html>
