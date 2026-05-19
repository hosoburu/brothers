<?php
// セッションを開始
session_start();

// セッションの情報をすべて削除
$_SESSION = array();
session_destroy();

// index.phpにリダイレクト
header('Location: /index.php');
exit;
