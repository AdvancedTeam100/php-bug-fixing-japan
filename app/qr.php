<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script> 
<script type="text/JavaScript"> 
    $(function(){
      var qrtext = "http://localhost/FeeHatCRM/back/qr_scan.php?user_id=".$user_data['id'];
      var utf8qrtext = unescape(encodeURIComponent(qrtext));
      $("#img-qr").html("");
      $("#img-qr").qrcode({text:utf8qrtext}); 
    });
</script>

<?php require('header.php');?>

<main>
    <h1>QRコード</h1>
    <p>ご来店時スタッフにお見せ下さい。</p>
    <div id="img-qr"></div>
</div>

</main>

<?php require('footer.php');?>
