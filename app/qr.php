<?php require('header.php');?>

<main>
    <h1>QRコード</h1>
    <p>ご来店時スタッフにお見せ下さい。</p>
    <div id="qrcode">
  <canvas width="256" height="256"></canvas>
</div>

</main>

<?php require('footer.php');?>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/dist/qrcode.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://example.com?id=123",
            width: 256,
            height: 256,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });
</script>
