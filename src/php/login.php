<?php
session_start();
$mail = $_POST['mail'];

// DB接続
include('./db/db.php');

$sql = "SELECT * FROM t_user WHERE mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();

if ($member && password_verify($_POST['pass'], $member['pass'])) {
    // DBのユーザー情報をセッションに保存
    $_SESSION['name'] = $member['name'];
    $_SESSION['mail'] = $member['mail']; // メールアドレスをセッションに保存
    $_SESSION['password_hash'] = $member['pass']; // ハッシュ化されたパスワードをセッションに保存

    echo json_encode(['status' => 'success', 'msg' => "ログインしました。\n1秒後にトップページに遷移します。"]);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'メールアドレスもしくはパスワードが間違っています。']);
}
exit;
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>