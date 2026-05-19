<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
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
        function showModal(message) {
            const modal = document.getElementById('myModal');
            const modalMessage = document.getElementById('modalMessage');
            message = message.replace(/\n/g, '<br>');
            modalMessage.innerHTML = message;
            modal.style.display = 'block';
            setTimeout(function() {
                modal.style.display = 'none';
            }, 1000);
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
        <p>会員登録がお済みでない方は<a href="/auth/signUp.php">こちら</a></p>
    </div>

    <!-- モーダル -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        async function login(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            const response = await fetch('/auth/login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.status === 'success') {
                showModal(result.msg);
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
