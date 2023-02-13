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
            <th>登録日</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach(array_reverse($users_data,true) as $user) :?>
        <tr>
            <td><?=$user['user_id'];?></td>
            <td><?=$user['name'];?></td>
            <td><?=$user['prefecture'];?></td>
            <td><?=$user['city'];?></td>
            <td><?=$user['birthday'];?></td>
            <td><?=$user['job'];?></td>
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
                                <form action="back/ch_popup.php" method="post">
                                <table>
                                    <tr>
                                        <td>トラッキングID</td>
                                        <td>
                                            <span id="tracking_id_d"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>タイトル</td>
                                        <td>
                                            <input type="text" name="title" id="title_d">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>メモ</td>
                                        <td>
                                            <textarea name="memo" id="memo_d"></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <button type="submit" class="btn btn-primary">変更</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail" 
                    onClick="handleClick(`<?= $row['id'];?>`,`<?= $row['title'];?>`,`<?= $row['memo'];?>`);">
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

<?php require('footer.php');?>