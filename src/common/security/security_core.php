<?php
require_once __DIR__ . '/../../models/Database.php';

$db = Database::connect();

$mail          = $_SESSION['mail'];
$password_hash = $_SESSION['password_hash'];

$stmt = $db->prepare("SELECT * FROM t_user WHERE mail = :mail");
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// DBのパスワードとセッションのハッシュが一致すればログイン有効
$_SESSION['login_flag'] = $user && ($password_hash === $user['pass']);
