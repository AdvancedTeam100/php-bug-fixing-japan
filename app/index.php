<?php require('header.php');?>
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


    <div class="user_info">
        <div class="user_rank_info">
            <p class="user_name">山田 太郎</p>
            <p class="user_rank">ゴールド会員</p>
        </div>
        <div class="rank_card">
            <img src="img/feehat.jpg" alt="">
        </div>
    </div>
      

    <main>
        <table class="contents">
            <td>
                <a href="qr.php"><h2>会員証</h2></a>
                <p>ここにQRコードを表示</p>
            </td>
            <td>
                <a href="shop_info.php"><h2>店舗情報</h2></a>
                <p>お店の情報はこちら！</p>
            </td>
            <td>
                <a href="stamp_card.php"><h2>スタンプカード</h2></a>
                <p>来店スタンプを集めてクーポンゲット♪</p>
            </td>
            <td>
                <a href="game.php"><h2>ゲーム</h2></a>
                <p>オリジナルスマホゲーム</p>
            </td>
            <td>
                <a href="https://feehatmember.bitter.jp/roulette/"><h2>ルーレット</h2></a>
                <p>カクテルメニューをランダムで選べる</p>
            </td>
            <td>
                <a href="mypage.php"><h2>マイページ</h2></a>
                <p>設定情報を確認できます。</p>
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