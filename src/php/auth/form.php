<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];

    // DB接続
    include('../db/db.php');

    $sql = "SELECT * FROM t_user WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();

    if ($member && isset($member['pass']) && password_verify($_POST['pass'], $member['pass'])) {
        $_SESSION['name'] = $member['name'];
        echo json_encode(['status' => 'success', 'msg' => 'ログインしました。']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'メールアドレスもしくはパスワードが間違っています。']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* モーダルのスタイル */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 上下中央に来るようにマージンを調整 */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            text-align: center;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 5px;
            right: 10px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        // モーダルを表示する関数
        function showModal(message) {
            const modal = document.getElementById('myModal');
            const modalMessage = document.getElementById('modalMessage');

            // 改行コード (\n) を HTML の改行タグ (<br>) に置換する
            message = message.replace(/\n/g, '<br>');

            modalMessage.innerHTML = message;
            modal.style.display = 'block';

            setTimeout(function() {
                modal.style.display = 'none';
            }, 1000); // 1秒後にモーダルを閉じる
        }
    </script>
</head>

<body>
    <div class="center-container">
        <form onsubmit="login(event)">
            <label for="mail">メールアドレス:</label>
            <input type="email" id="mail" name="mail" required>
            <br>
            <label for="pass">パスワード:</label>
            <input type="password" id="pass" name="pass" required>
            <br>
            <button type="submit">ログイン</button>
        </form>
        <p>会員登録がお済みでない方は<a href="/php/register/signUp.php">こちら</a></p>
    </div>

    <!-- モーダル -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        // フォーム送信時の処理
        async function login(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.status === 'success') {
                // ログイン成功時にメッセージを表示
                showModal(result.msg);

                // 1秒後にindex.phpに遷移
                setTimeout(function() {
                    window.location.href = '/index.php';
                }, 1000);
            } else {
                showModal(result.msg);
            }
        }
    </script>
</body>

</html>