<?php
include('../common.php');

// POSTデータからユーザーIDと削除するタグを取得
$user_id = $_POST['user_id'];
$tag = str_replace('-', '', $_POST['tag']);

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    // 現在のタグ情報を取得
    $stmt = $db->prepare('SELECT tag FROM users WHERE user_id = :user_id');
    $stmt->execute(array(':user_id' => $user_id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $tags = explode(',', $result['tag']);
    
    // 削除するタグを検索して削除
    $index = array_search($tag, $tags);
    if ($index !== false) {
        array_splice($tags, $index, 1);
    }
    
    // 新しいタグ情報を更新
    $new_tag = implode(',', $tags);
    $stmt = $db->prepare('UPDATE users SET tag = :tag WHERE user_id = :user_id');
    $stmt->execute(array(':user_id' => $user_id, ':tag' => $new_tag));

    $db = null;
} catch(PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
}

header('Location: '.$_SERVER['HTTP_REFERER']);
exit();
?>
