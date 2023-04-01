<?php
include('../common.php');

try {
    $db = new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// フォームから送信されたデータを取得
$title = $_POST['title'];
$body = $_POST['body'];

// 画像をアップロード
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "ファイルが画像ではありません。";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "ファイルが既に存在します。";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "jpg, jpeg, png, gif 以外のファイルはアップロードできません。";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "ファイルはアップロードされませんでした。";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "ファイル ". htmlspecialchars( basename( $_FILES["image"]["name"])). " がアップロードされました。";
        $image_path = "uploads/" . basename($_FILES["image"]["name"]);

        // データベースにデータを保存
        $sql = "INSERT INTO columns (title, body, image_path) VALUES (:title, :body, :image_path)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':body', $body, PDO::PARAM_STR);
        $stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        echo "ファイルのアップロード中にエラーが発生しました。";
    }
}

$db= null;
?>

<script>
  alert('コラムを投稿しました。');
  window.location.href = '../column_list.php';
</script>
