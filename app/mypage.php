<?php require('header.php');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script> 

<main>
    <h1>マイページ</h1>
    <p>アカウント情報</p>
    <table class="mypage_table">
    <tr>
    <th data-label="ID">ID</th>
    <td data-label=""><?php echo $user_data['user_id']; ?></td>
  </tr>
  <tr>
    <th data-label="名前">名前</th>
    <td data-label=""><?php echo $user_data['name']; ?></td>
  </tr>
  <tr>
    <th data-label="ステータス">ステータス</th>
    <td data-label=""><?php echo $user_data['status']; ?></td>
  </tr>
  <tr>
    <th data-label="メールアドレス">メールアドレス</th>
    <td data-label=""><?php echo $user_data['email']; ?></td>
  </tr>
  <tr>
    <th data-label="電話番号">電話番号</th>
    <td data-label=""><?php echo $user_data['tel']; ?></td>
  </tr>
  <tr>
    <th data-label="都道府県">都道府県</th>
    <td data-label=""><?php echo $user_data['prefecture']; ?></td>
  </tr>
  <tr>
    <th data-label="市区町村">市区町村</th>
    <td data-label=""><?php echo $user_data['city']; ?></td>
  </tr>
  <tr>
    <th data-label="誕生日">誕生日</th>
    <td data-label=""><?php echo $user_data['birthday']; ?></td>
  </tr>
  <tr>
    <th data-label="性別">性別</th>
    <td data-label=""><?php echo $user_data['sex']; ?></td>
  </tr>
  <tr>
    <th data-label="職業">職業</th>
    <td data-label=""><?php echo $user_data['job']; ?></td>
  </tr>
  </table>
</main>

<?php require('footer.php');?>
