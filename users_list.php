<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users_data = $stmt->fetchAll();

}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};

?>

<?php require('header.php');?>
    <?php require('menu.php');?>
<main>
    <h1>会員一覧</h1>
    <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新規登録</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- modal-body -->
                <div class="modal-body" id="modal_req">
                <form action="./back/new_popup.php" method="post">
                    <table>
                        <tr>
                            <td>タイトル</td>
                            <td>
                                <input type="text" name="title">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                </div>
                <div class="modal-footer">
                            <input type="hidden" name="cid" value="<?=$client_id?>">
                            <button type="submit" class="btn btn-secondary">作成</button>
                        </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
        新規作成</button>

    <br><br>

    <table class="t">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>都道府県</th>
            <th>市</th>
            <th>生年月日</th>
            <th>職業</th>
            <th>ステータス</th>
            <th>来店回数</th>
            <th>登録日</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach(array_reverse($users_data,true) as $user) :
            $stmt = $db->prepare("SELECT * FROM visits WHERE user_id=?");
            $stmt->execute([$user['user_id']]);
            $vists_cnt = count($stmt->fetchAll());
            ?>
        <tr>
            <td><?=$user['user_id'];?></td>
            <td><?=$user['name'];?></td>
            <td><?=$user['prefecture'];?></td>
            <td><?=$user['city'];?></td>
            <td><?=$user['birthday'];?></td>
            <td><?=$user['job'];?></td>
            <td><?=$user['status'];?></td>
            <td><?=$vists_cnt;?></td>
            <td><?=$user['created_at'];?></td>
            <td>
                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">詳細</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- modal-body -->
                            <div class="modal-body" id="modal_req">
                                <form action="back/ch_user.php" method="post" id="change-form">
                                <table>
                                    <tr>
                                    <td>ID</td>
                                    <td><input type="text" id="user_id" name="user_id" readonly></td>
                                    </tr>
                                    <tr>
                                    <td>名前</td>
                                    <td><input type="text" id="name" name="name"></td>
                                    </tr>
                                    <tr>
                                    <td>ステータス</td>
                                    <td>
                                        <select id="status" name="status">
                                        <option value="ブロンズ会員">ブロンズ会員</option>
                                        <option value="シルバー会員">シルバー会員</option>
                                        <option value="ゴールド会員">ゴールド会員</option>
                                        <option value="プラチナ会員">プラチナ会員</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <td>メールアドレス</td>
                                    <td><input type="email" id="email" name="email"></td>
                                    </tr>
                                    <tr>
                                    <td>電話番号</td>
                                    <td><input type="text" id="tel" name="tel"></td>
                                    </tr>
                                    <tr>
                                    <td>都道府県</td>
                                    <td>
                                    <select name="prefecture" id="prefecture">
                                        <option value="北海道">北海道</option>
                                        <option value="青森県">青森県</option>
                                        <option value="岩手県">岩手県</option>
                                        <option value="宮城県">宮城県</option>
                                        <option value="秋田県">秋田県</option>
                                        <option value="山形県">山形県</option>
                                        <option value="福島県">福島県</option>
                                        <option value="茨城県">茨城県</option>
                                        <option value="栃木県">栃木県</option>
                                        <option value="群馬県">群馬県</option>
                                        <option value="埼玉県">埼玉県</option>
                                        <option value="千葉県">千葉県</option>
                                        <option value="東京都">東京都</option>
                                        <option value="神奈川県">神奈川県</option>
                                        <option value="新潟県">新潟県</option>
                                        <option value="富山県">富山県</option>
                                        <option value="石川県">石川県</option>
                                        <option value="福井県">福井県</option>
                                        <option value="山梨県">山梨県</option>
                                        <option value="長野県">長野県</option>
                                        <option value="岐阜県">岐阜県</option>
                                        <option value="静岡県">静岡県</option>
                                        <option value="愛知県">愛知県</option>
                                        <option value="三重県">三重県</option>
                                        <option value="滋賀県">滋賀県</option>
                                        <option value="京都府">京都府</option>
                                        <option value="大阪府">大阪府</option>
                                        <option value="兵庫県">兵庫県</option>
                                        <option value="奈良県">奈良県</option>
                                        <option value="和歌山県">和歌山県</option>
                                        <option value="鳥取県">鳥取県</option>
                                        <option value="島根県">島根県</option>
                                        <option value="岡山県">岡山県</option>
                                        <option value="広島県">広島県</option>
                                        <option value="山口県">山口県</option>
                                        <option value="徳島県">徳島県</option>
                                        <option value="香川県">香川県</option>
                                        <option value="愛媛県">愛媛県</option>
                                        <option value="高知県">高知県</option>
                                        <option value="福岡県">福岡県</option>
                                        <option value="佐賀県">佐賀県</option>
                                        <option value="長崎県">長崎県</option>
                                        <option value="熊本県">熊本県</option>
                                        <option value="大分県">大分県</option>
                                        <option value="宮崎県">宮崎県</option>
                                        <option value="鹿児島県">鹿児島県</option>
                                        <option value="沖縄県">沖縄県</option>
                                    </select>

                                    </td>
                                    </tr>
                                    <tr>
                                    <td>市</td>
                                    <td><input type="text" id="city" name="city"></td>
                                    </tr>
                                    <tr>
                                    <td>生年月日</td>
                                    <td><input type="date" id="birthday" name="birthday"></td>
                                    </tr>
                                    <tr>
                                    <td>性別</td>
                                    <td>
                                        <select id="sex" name="sex">
                                        <option value="男性">男性</option>
                                        <option value="女性">女性</option>
                                        <option value="その他">その他</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>職業</td>
                                    <td><input type="text" id="job" name="job"></td>
                                    </tr>
                                    <tr>
                                    <td>タグ</td>
                                    <td><textarea id="tag" name="tag"></textarea></td>
                                    </tr>
                                    <tr>
                                    <td>メモ</td>
                                    <td><textarea id="memo" name="memo"></textarea></td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <button type="submit" class="btn btn-primary">編集</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail" 
                    onClick="handleClick(`<?= $user['user_id'];?>`);">
                    詳細</button>
                </td>
                <td>
                    <form action="./back/del_user.php" method="post">
                        <button type="button" class="btn btn-secondary">削除</button>
                    </form>
                </td>

        </tr>
        <?php endforeach;?>
    </table>
</main>

<script>
    const form = document.getElementById('change-form');
    form.addEventListener('submit', (event) => {
        const confirmed = confirm('本当に変更してもよろしいですか？');
        if (!confirmed) {
        event.preventDefault(); // formの送信をキャンセル
        }
    });

    function handleClick(id) {
        // モーダルにユーザー情報を表示
        const user = <?= json_encode($users_data); ?>.find(u => u.user_id == id);
        document.querySelector('#user_id').value = user.user_id;
        document.querySelector('#name').value = user.name;
        document.querySelector('#status').value = user.status;
        document.querySelector('#email').value = user.email;
        document.querySelector('#tel').value = user.tel;
        document.querySelector('#prefecture').value = user.prefecture;
        document.querySelector('#city').value = user.city;
        document.querySelector('#birthday').value = user.birthday;
        document.querySelector('#sex').value = user.sex;
        document.querySelector('#job').value = user.job;
        document.querySelector('#tag').value = user.tag;
        document.querySelector('#memo').value = user.memo;

        // 変更フォームのIDに値をセット
        document.querySelector('#detail_id').value = id;
    }
</script>
<?php require('footer.php');?>