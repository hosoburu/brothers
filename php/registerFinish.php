<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー登録 完了画面</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/member.css">
  <link rel="stylesheet" href="../css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="../img/fabicon.ico">
</head>

<body>
  <?php include('./common/header.php'); ?>
  <?php include('./db/db.php'); ?>

  <?php
  //セッションを開始
  session_start();
  ?>

  <?php
  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $dbh->query($_SESSION['sql']);
  ?>
  <p>
    メンバーの登録が完了しました。
  </p>
  <p>
    <label for="name">ID：</label><?php echo $_POST["id"] ?>
  </p>
  <p>
    <label for="name">名前：</label><?php echo $_POST["name"] ?>
  </p>

  <?php include('./common/footer.php'); ?>
</body>

</html>