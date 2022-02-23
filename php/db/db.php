<?php
$host = getenv('HOST');
$dbName = getenv('DBNAME');
$user = getenv('USER');
$password = getenv('PASSWORD');
$dsn = "pgsql:host={$host};dbname={$dbName}?sslmode=require";

// tryにPDOの処理を記述
try {

  // PDOインスタンスを生成
  $dbh = new PDO($dsn, $user, $password);

  // エラー（例外）が発生した時の処理を記述
} catch (PDOException $e) {

  // エラーメッセージを表示させる
  echo 'データベースにアクセスできません！' . $e->getMessage();

  // 強制終了
  exit;
}
