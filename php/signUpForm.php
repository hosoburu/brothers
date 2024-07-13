<h1>新規会員登録</h1>
<form action="registerUser.php" method="post">
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
            <input type="" name="brotherspass" required>
        </label>
    </div>
    <input type="submit" value="新規登録">
</form>
<p>すでに会員登録済みの方は<a href="loginForm.php">こちら</a></p>