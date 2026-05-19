<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>新規会員登録</title>
</head>

<body>

    <form action="user.php" method="post">
        <div>
            <label>
                名前：
                <input type="text" name="name" required>
            </label>
        </div>
        <div>
            <label>
                メールアドレス：
                <input type="text" name="mail" required>
            </label>
        </div>
        <div>
            <label>
                パスワード：
                <input type="password" name="pass" required>
            </label>
        </div>
        <div>
            <label>
                ブラザーズID：
                <input type="password" name="brotherspass" required>
            </label>
        </div>
        <input type="submit" value="新規登録">
    </form>
    <p>すでに会員登録済みの方は<a href="/php/auth/form.php">こちら</a></p>
</body>

</html>