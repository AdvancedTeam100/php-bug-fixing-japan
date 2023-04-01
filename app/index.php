<?php require('header.php');

// データベースから最新の投稿データを取得
try{
  $db = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  $stmt = $db->prepare("SELECT * FROM columns ORDER BY created_at DESC LIMIT 1");
  $stmt->execute();
  $latest_column = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
  echo '接続失敗' . $e->getMessage();
  exit();
}

// 最新の投稿データを整形してHTMLに当てはめる
$title = htmlspecialchars($latest_column['title'], ENT_QUOTES, 'UTF-8');
$body = mb_substr(strip_tags($latest_column['body']), 0, 50, 'UTF-8') . '...';
$link = 'column.php';
?>

<div class="slideshow-container">
    <div class="mySlides fade">
        <img src="img/feehat.jpg" alt="">
    </div>
    <div class="mySlides fade">
        <img src="img/cocktail.jpg" alt="">
    </div>
    <div class="mySlides fade">
        <img src="img/room.jpg" alt="">
    </div>
    <div class="dots" style="display: flex; justify-content: center;">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>

<div class="container">
  <div class="column">
    <div class="image-container">
      <img src="img/ruito.jpg" alt="Profile photo">
    </div>
    <div class="text-container">
        <h2 class="title"><?= $title ?></h2>
        <p class="excerpt"><?= $body ?></p>
        <a href="<?= $link ?>">続きを読む</a>
    </div>
  </div>
</div>


    <main>
        <table class="contents">
            <td>
                <a href="qr.php">
                    <img src="./img/qr.png">
                    <h2>会員証</h2>
                </a>
                <p>ここにQRコードを表示</p>
            </td>
            <td>
                <a href="point.php">
                    <img src="./img/p.png">
                    <h2>ポイント管理</h2>
                </a>
                <p>FeeHatポイントを表示</p>
            </td>
            <td>
                <a href="stamp_card.php">
                    <img src="./img/stamp_card.png">
                    <h2>スタンプカード</h2>
                </a>
                <p>来店スタンプを集めてクーポンゲット♪</p>
            </td>
            <td>
                <a href="coupon_history.php">
                    <img src="./img/coupon_history.png">
                    <h2>クーポン履歴</h2>
                </a>
                <p>クーポンの使用履歴を確認できます。</p>
            </td>
            <td>
                <a href="game.php">
                    <img src="./img/game.png">
                    <h2>ゲーム</h2>
                </a>
                <p>オリジナルスマホゲーム</p>
            </td>
            <td>
                <a href="https://feehatmember.bitter.jp/roulette/">
                    <img src="./img/roulette.png">
                    <h2>ルーレット</h2>
                </a>
                <p>カクテルメニューをランダムで選べる</p>
            </td>
            <td>
                <a href="mypage.php">
                    <img src="./img/mypage.png">
                    <h2>アカウント情報</h2>
                </a>
                <p>設定情報を確認できます。</p>
            </td>
            <td>
                <a href="shop_info.php">
                    <img src="./img/shop_info.png">
                    <h2>店舗情報</h2>
                </a>
                <p>お店の情報はこちら！</p>
            </td>
        </table>
      
    </main>
    <?php require('footer.php');?>

    <script>
var slideIndex = 1;

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.opacity = 0; // フェードアウトのアニメーション
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.opacity = 1; // フェードインのアニメーション
  dots[slideIndex-1].className += " active";
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  setTimeout(showSlides, 5000);
}

window.addEventListener('load', function() {
  showSlides(slideIndex);
});


    </script>
</body>
</html>