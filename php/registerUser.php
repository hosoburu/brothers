<?php
//フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$brotherspass = $_POST['brotherspass'];

// DB接続
include('./db/db.php');

// ブラザーズIDをチェック
$sql = "SELECT * FROM t_brothers WHERE id = 'brotherspass'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$t_brothers = $stmt->fetch();
if ($t_brothers['pass'] !== $brotherspass) {
    $msg = 'ブラザーズIDが違います。';
    $link = '<a href="signUpForm.php">戻る</a>';
} else {
    //フォームに入力されたmailがすでに登録されていないかチェック
    $sql = "SELECT * FROM t_user WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();
    if ($member !== false && $member['mail'] === $mail) {
        $msg = '同じメールアドレスが存在します。';
        $link = '<a href="signUpForm.php">戻る</a>';
    } else {
        //登録されていなければinsert 
        $sql = "INSERT INTO t_user(name, mail, pass) VALUES (:name, :mail, :pass)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':mail', $mail);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();
        $msg = '会員登録が完了しました';
        $link = '<a href="loginForm.php">ログインページへ</a>';
    }
}

?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>