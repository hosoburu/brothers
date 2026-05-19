<?php if (isset($_SESSION['mail']) && isset($_SESSION['password_hash'])) : ?>

    <?php include(__DIR__ . '/security_core.php'); ?>
    <?php
    // ログイン状態を確認
    if ($_SESSION['login_flag']) {
        echo '<p>' . htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') . ' さん。ログイン中。</p>';
        echo '<a href="/auth/logout.php">ログアウト</a>';
    } else {
        // セッションに保存されている認証情報が不正な場合は、モーダルを表示してログアウト処理を行い、リダイレクトする
        session_unset(); // セッション変数を全て削除
        session_destroy(); // セッションを破棄
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '  var modal = document.getElementById("myModal");';
        echo '  modal.style.display = "block";'; // モーダルを表示する
        echo '  setTimeout(function() {';
        echo '    window.location.href = "/index.php";'; // index.phpへのリダイレクト
        echo '  }, 3000);'; // 3秒後にリダイレクト
        echo '});';
        echo '</script>';
    }
    ?>
<?php else : ?>
    <p>ログインしていません。</p>
    <a href="/auth/form.php">ログイン</a>
    <br>
    <a href="/auth/signUp.php">新規会員登録はこちら</a>
<?php endif; ?>