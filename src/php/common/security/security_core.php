<?php
// DB接続
include('./db/db.php');

// セッションに保存されたメールアドレスとハッシュ化されたパスワードを使ってDBからユーザーを取得
$mail = $_SESSION['mail'];
$password_hash = $_SESSION['password_hash'];

$sql = "SELECT * FROM t_user WHERE mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザーが存在し、セッションのハッシュ化されたパスワードがDBのパスワードと一致するか確認
$_SESSION['login_flag'] = $user && ($password_hash == $user['pass']);
