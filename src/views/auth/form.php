<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BROTHERS</title>
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/fabicon.ico">
    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth-card {
            background-color: rgb(238, 198, 162);
            border: 2px solid rgb(44, 42, 43);
            border-radius: 20px;
            padding: 32px 24px;
            width: 100%;
            max-width: 360px;
            margin: 20px;
        }

        .auth-card h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 24px;
            color: rgb(34, 32, 30);
            background: rgb(194, 202, 202);
            border: 2px solid rgb(37, 34, 34);
            border-radius: 12px;
            padding: 8px;
        }

        .auth-card label {
            display: block;
            margin-bottom: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .auth-card input[type="email"],
        .auth-card input[type="password"] {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #aaa;
            border-radius: 6px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .auth-card button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: rgb(64, 71, 69);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 4px;
        }

        .auth-card button[type="submit"]:hover {
            background-color: rgb(44, 51, 49);
        }

        .auth-card .auth-link {
            text-align: center;
            margin-top: 16px;
            font-size: 13px;
        }

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
            border-radius: 10px;
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
            modalMessage.textContent = '';
            message.split('\n').forEach((line, i) => {
                if (i > 0) modalMessage.appendChild(document.createElement('br'));
                modalMessage.appendChild(document.createTextNode(line));
            });
            modal.style.display = 'block';
            setTimeout(function() {
                modal.style.display = 'none';
            }, 1000);
        }
    </script>
</head>

<body>
    <div class="auth-card">
        <h1>BROTHERS</h1>
        <form onsubmit="login(event)">
            <label for="mail">メールアドレス</label>
            <input type="email" id="mail" name="mail" required>
            <label for="pass">パスワード</label>
            <input type="password" id="pass" name="pass" required>
            <button type="submit">ログイン</button>
        </form>
        <p class="auth-link">会員登録がお済みでない方は<a href="/auth/signUp.php">こちら</a></p>
    </div>

    <!-- モーダル -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('myModal').style.display = 'none';
        });

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
