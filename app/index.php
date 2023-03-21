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
            <p class="user_name"><?=$user_data['name']?> 様</p>
            <p class="user_rank"><?=$user_data['status']?></p>
        </div>
        <div class="rank_card">
            <img src="img/bronze.png" alt="">
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