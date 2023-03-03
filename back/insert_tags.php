<?php
if(isset($_POST['user_id']) && isset($_POST['new_tag'])){
    include('../common.php');

    $user_id = $_POST['user_id'];
    $new_tag = $_POST['new_tag'];

    try{
        $db = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        // ユーザーのタグ情報を取得する
        $stmt = $db->prepare('SELECT tag FROM users WHERE user_id = :user_id');
        $stmt->execute(array(':user_id' => $user_id));
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // ユーザーの既存のタグ情報を配列に変換する
        $tags_array = array();
        if ($user_data['tag']) {
            $tags_array = explode(',', $user_data['tag']);
        }

        // 既存のタグ情報に新しいタグが含まれていない場合、新しいタグを追加する
        if (!in_array($new_tag, $tags_array)) {
            $tags_array[] = $new_tag;
        }

        // 配列をカンマ区切りの文字列に変換して、ユーザーのタグ情報を更新する
        $tags = implode(',', $tags_array);
        $stmt = $db->prepare('UPDATE users SET tag=:tag WHERE user_id = :user_id');
        $stmt->execute(array(':user_id' => $user_id,':tag' => $tags));

        $db = null;
    } catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
    };
    
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}

?>
