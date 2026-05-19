<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録 - BROTHERS</title>
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

        .auth-card input[type="text"],
        .auth-card input[type="email"],
        .auth-card input[type="password"] {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #aaa;
            border-radius: 6px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .auth-card input[type="submit"] {
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

        .auth-card input[type="submit"]:hover {
            background-color: rgb(44, 51, 49);
        }

        .auth-card .auth-link {
            text-align: center;
            margin-top: 16px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <h1>BROTHERS</h1>
        <form action="/auth/user.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
            <label for="name">名前</label>
            <input type="text" id="name" name="name" required>
            <label for="mail">メールアドレス</label>
            <input type="email" id="mail" name="mail" required>
            <label for="pass">パスワード</label>
            <input type="password" id="pass" name="pass" required>
            <label for="brotherspass">ブラザーズID</label>
            <input type="password" id="brotherspass" name="brotherspass" required>
            <input type="submit" value="新規登録">
        </form>
        <p class="auth-link">すでに会員登録済みの方は<a href="/auth/form.php">こちら</a></p>
    </div>
</body>

</html>
