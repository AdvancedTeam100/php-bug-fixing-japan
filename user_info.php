<?php
require('common.php');

try{
    $db= new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users_data = $stmt->fetchAll();

   
    if(isset($_GET['user_id'])){
        $get_id = $_GET['user_id'];
    }else  $get_id = 1;

    $stmt = $db->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->execute([$get_id]);
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT * FROM question_items");
    $stmt->execute();
    $question_items_data = $stmt->fetchAll();

    $stmt = $db->prepare("SELECT * FROM answers WHERE user_id=?");
    $stmt->execute([$get_id]);
    $answers_data = $stmt->fetch(PDO::FETCH_ASSOC);

    $currentDate = new DateTime();
    $ageInterval = $currentDate->diff(new DateTime($user_data['birthday']));
    $ageInYears = $ageInterval->y;

    
}catch(PDOException $e){
        echo '接続失敗' . $e->getMessage();
        exit();
};

?>

<?php require('header.php');?>
    <?php require('menu.php');?>
<main>
    <h1>会員情報</h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="inner_col_1">
                <table>
                    <td><i class="fa fa-user"></i></td>
                    <td><h2><?php echo $user_data['name']?>　様</h2></td>
                    <td><span class="status"><?php echo $user_data['status']?></span></td>
                </table>

                <table class="tag">
                    <?php
                        $tags = explode(',', $user_data['tag']);
                        foreach($tags as $tag){
                            echo '<td class="tag-name">'.$tag.'<span class="tag-delete">-</span></td>';
                        }
                    ?>
                    <form action="back/insert_tags.php" method="post">
                        <td>
                            <input type="text" placeholder="タグを入力" name="new_tag" class="tag" required>
                            <input type="hidden" name="user_id" value="<?=$user_data['user_id']?>">
                        </td>
                        <td class="td_reset"><button class="btn btn-secondary">追加</button></td>
                    </form>
                </table>

                <script>
                    const tagDeletes = document.querySelectorAll('.tag-delete');
                    tagDeletes.forEach(tagDelete => {
                        tagDelete.addEventListener('click', (event) => {
                            event.stopPropagation();
                            const tagName = tagDelete.parentElement.textContent.trim();
                            const deleteForm = document.createElement('form');
                            deleteForm.setAttribute('action', 'back/delete_tags.php');
                            deleteForm.setAttribute('method', 'post');
                            deleteForm.innerHTML = '<input type="hidden" name="user_id" value="<?=$user_data['user_id']?>">' +
                                                '<input type="hidden" name="tag" value="' + tagName + '">' +
                                                '<button type="submit" class="tag-delete">-</button>';
                            document.body.appendChild(deleteForm);
                            deleteForm.submit();
                        });
                    });
                    const tagNames = document.querySelectorAll('.tag-name');
                    tagNames.forEach(tagName => {
                        tagName.addEventListener('click', () => {
                            const tagDelete = tagName.querySelector('.tag-delete');
                            tagDelete.style.display = tagDelete.style.display === 'block' ? 'none' : 'block';
                        });
                    });
                </script>

                <br>
                生年月日　：　<?=$user_data['birthday']?>　<?=$ageInYears?>歳<br>
                お住まい　：　<?=$user_data['prefecture']?> <?=$user_data['city']?><br>
                登録日　　：　<?=$user_data['created_at']?><br>
                <br>
                スタッフメモ：<br>
                <form action="back/ch_staff_memo.php" method="post">
                    <input type="hidden" name="user_id" value="<?=$user_data['user_id']?>">
                    <textarea name="memo" id="" cols="65" rows="10"><?=$user_data['memo']?></textarea>
                    <button type="submit" class="btn btn-secondary">編集</button>
                </form>
                <br><br>
                アンケート回答：<br>
                <table class="t">
                    <tr>
                        <th>質問</th>
                        <th>回答</th>
                    </tr>
                    <?php
                    if(isset($question_items_data) && isset($answers_data)){
                        
                        foreach($question_items_data as $i => $q){
                            echo "
                            <tr>
                                <td>".$q['question']."</td>
                                
                            </tr>
                            ";
                        }
                    }
                        
                    ?>
                </table>
            </div>
        </div>
        <!-- 名前一覧 -->
        <div class="col-lg-6">
            <div class="inner_col_2">
                <input type="search" name="search" placeholder="名前で検索">

                <br><br>
                <?php foreach($users_data as $user){
                    echo '
                    <form action="" method="get">
                        <input type="hidden" name="user_id" value="'.$user['user_id'].'">
                        <button>'.$user['name'].'</button>
                    </form>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php require('footer.php');?>