<script>
// メニュー項目の展開
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll("aside h2").forEach(function(item) {
    var submenu = item.nextElementSibling;
    submenu.style.display = 'none'; // 初期状態は閉じる
    item.addEventListener('click', function() {
      submenu.style.display = submenu.style.display === 'none' ? '' : 'none';
    });
  });
});

</script>

<nav class="side-nav">
    <aside>
        <h2><i class="fa fa-home"></i>ダッシュボード</h2>
        <ul>
            <li><a href="question_item.php"><i class="fas fa-info-circle"></i>概要</a></li>
        </ul>
        <h2><i class="fa fa-user"></i>会員</h2>
        <ul>
            <li><a href="users_list.php"><i class="fas fa-users"></i>会員一覧</a></li>
            <li><a href="user_info.php"><i class="fas fa-user-circle"></i>会員情報</a></li>
            <li><a href="visits.php"><i class="fas fa-clipboard-list"></i>来店履歴</a></li>
        </ul>
        <h2><i class="fas fa-star"></i>ランキング</h2>
        <ul>
            <li><a href="visit_rank.php"><i class="fas fa-chart-line"></i>来店回数</a></li>
            <li><a href="age_sex_rank.php"><i class="fas fa-chart-pie"></i>年代・性別</a></li>
            <li><a href="live_in_rank.php"><i class="fas fa-map-marker-alt"></i>住まい</a></li>
            <li><a href="job.rank.php"><i class="fas fa-briefcase"></i>職業</a></li>
            <li><a href="coupon_rank.php"><i class="fas fa-award"></i>クーポン</a></li>
            <li><a href="game.rank.php"><i class="fas fa-gamepad"></i>ゲーム</a></li>
        </ul>
        <h2><i class="fas fa-poll"></i>アンケート</h2>
        <ul>
            <li><a href="question_item.php"><i class="fas fa-tasks"></i>アンケート内容</a></li>
            <li><a href="questionnaire_tally.php"><i class="fas fa-poll-h"></i>アンケート集計</a></li>
        </ul>
        <h2><i class="fa fa-cog"></i>クーポン管理</h2>
        <ul>
            <li><a href="coupon_list.php"><i class="fas fa-ticket-alt"></i>クーポン一覧</a></li>
            <li><a href="coupon_history.php"><i class="fas fa-history"></i>クーポン使用履歴</a></li>
        </ul>
        <h2><i class="fas fa-pen"></i>コラム</h2>
        <ul>
            <li><a href="column_list.php"><i class="fas fa-list"></i>投稿一覧</a></li>
        </ul>
        <h2><i class="fa fa-cog"></i>配信設定</h2>
        <ul>
            <li><a href="distribution_tags.php"><i class="fas fa-tags"></i>タグ抽出</a></li>
        </ul>
    </aside>
    </nav>