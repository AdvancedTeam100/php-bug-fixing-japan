<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM visits");
    $stmt->execute();
    $visits_data = $stmt->fetchAll();

}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};

?>

<?php require('header.php');?>
    <?php require('menu.php');?>
<main>
    <h1>来店履歴</h1>

    <table class="t">
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>来店者名</th>
            <th>メモ</th>
            <th>来店日時</th>
            <th></th>
        </tr>
        <?php 
        foreach(array_reverse($visits_data,true) as $key => $visit) :
            try{
                $db= new PDO($dsn,$user,$pass,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
                $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
                $stmt->execute([$visit['user_id']]);
                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                    echo '接続失敗' . $e->getMessage();
                    exit();
            };
            
        ?>
        <tr>
            <td><?=$key+1;?></td>
            <td><?=$visit['user_id'];?></td>
            <td><?=$user_data['name'];?></td>
            <td><?=$visit['memo'];?></td>
            <td><?=$visit['visit_date'];?></td>
            <td>
                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">メモ <span id="name"></span>様</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- modal-body -->
                            <div class="modal-body" id="modal_req">
                                <form action="back/ch_visit_memo.php" method="post">
                                <table>
                                    <tr>
                                        <td>メモ</td>
                                        <td>
                                            <textarea id="memo" name="memo"></textarea>
                                        </td>
                                    </tr>
                                   
                                </table>
                                <br>
                                <br>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="user_id" id="user_id">
                                <button type="submit" class="btn btn-primary">変更</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail" 
                    onClick="handleClick(`<?= $visit['user_id'];?>`,`<?= $user_data['name'];?>`,`<?= $visit['memo'];?>`);">
                    編集</button>
                </td>

        </tr>
        <?php endforeach;?>
    </table>
</main>
<script>
    function handleClick(user_id,name,memo){
        document.getElementById("user_id").value = user_id;
        document.getElementById("name").innerText = name;
        document.getElementById("memo").value = memo;
    }
</script>
<?php require('footer.php');?>