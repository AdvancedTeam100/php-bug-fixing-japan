<?php
require('common.php');

$tag_array = [];

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    // ユーザーデータを取得
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users_data = $stmt->fetchAll();
    
    // タグの配列を生成
    foreach($users_data as $user) {
        $tags = explode(',', $user['tag']);
        foreach($tags as $tag){
            $tag_array[] = $tag;
        }
    }
    
    // タグで絞り込み
    $checked_data = [];
    if(isset($_POST['tags'])) {
        $where = [];
        $params = [];
        foreach($_POST['tags'] as $tag) {
            $where[] = "tag LIKE ?";
            $params[] = "%{$tag}%";
        }
        $sql = "SELECT * FROM users WHERE " . implode(" OR ", $where);
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $checked_data = $stmt->fetchAll();
    }
    
} catch(PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}

?>

<?php require('header.php');?>
<?php require('menu.php');?>
<main>
        <h1>タグ抽出</h1>
        <h2>送信するタグを選んでください。</h2>
        <form method="post" action="">
            <div class="row">
                <?php foreach($tag_array as $tag) : ?>
                    <div class="col-md-2">
                        <label class="checkbox-label">
                            <input type="checkbox" name="tags[]" value="<?php echo $tag; ?>" <?php if(isset($_POST['tags']) && in_array($tag, $_POST['tags'])) echo 'checked'; ?>>
                            <?php echo $tag; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </div>
        </form>
        <br>
        
        <div class="row mt-3">
            <?php if(!empty($checked_data)) : ?>
        <div class="col-md-12">
            <p>選択された件数：<?=count($checked_data)?>件</p>
        </div>
        <br>
        <br>
        <h2>メッセージを作成</h2>
        <br>
        <div class="col-md-12">
            <form method="post" action="">
                <div class="form-group">
                    <label for="selectUser">送信先ユーザー</label>
                    <select class="form-control" id="selectUser" name="selectedUser">
                        <option>-- ユーザー一覧 --</option>
                        <?php foreach($checked_data as $data) : ?>
                            <option value="<?php echo $data['user_id']; ?>"><?php echo $data['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">メッセージ</label>
                    <textarea class="form-control" id="message" name="message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">送信する</button>
            </form>
        </div>
    <?php endif; ?>
</div>


</main>

<?php require('footer.php');?>
