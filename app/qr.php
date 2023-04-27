<?php require('header.php');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script> 
<script type="text/JavaScript"> 
    $(function(){
      var qrtext = "http://localhost/FeeHatCRM/back/qr_scan.php?user_id=<?=$user_id?>";
      var utf8qrtext = unescape(encodeURIComponent(qrtext));
      $("#img-qr").html("");
      $("#img-qr").qrcode({text:utf8qrtext}); 
    });
</script>

<main>
<div class="user_info">
        <div class="user_rank_info">
            <p class="user_name"><?=$user_data['name']?> 様</p>
            <p class="user_rank"><?=$user_data['status']?></p>
        </div>
        <div class="rank_card">
            <img src="img/bronze.png" alt="">
        </div>
    </div>
    <h1>QRコード</h1>
    <p>ご来店時スタッフにお見せ下さい。</p>
    <div id="img-qr"></div>
</div>

</main>

<?php require('footer.php');?>
