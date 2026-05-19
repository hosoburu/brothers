<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー登録 完了画面</title>
  <link rel="stylesheet" href="../../css/common.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/member.css">
  <link rel="stylesheet" href="../../css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="../../img/fabicon.ico">
</head>

<body>
  <?php include('../common/header.php'); ?>
  <h2 class="heading-title">RECRUITMENT COMPLETION</h2>
  <?php include('../db/db.php'); ?>

  <?php
  // セッションからパラメータを取得
  $p = $_SESSION['register_params'] ?? [];

  // 最新のIDを取得して次のIDを決定
  $idStmt = $dbh->query("SELECT COALESCE(MAX(id), 0) + 1 AS next_id FROM t_member");
  $idRow = $idStmt->fetch(PDO::FETCH_ASSOC);
  $newId = $idRow['next_id'];

  // プリペアドステートメントでINSERT
  $sql = "INSERT INTO t_member (id, name, explanation, img, atk, def, spd, hp, mp, skill1, skill2, skill3, skill4, skill5, skill6)
    VALUES(:id, :name, :explanation, :img, :atk, :def, :spd, :hp, :mp, :skill1, :skill2, :skill3, :skill4, :skill5, :skill6)";
  $stmt = $dbh->prepare($sql);
  $stmt->execute([
    ':id'          => $newId,
    ':name'        => $p['name']        ?? '',
    ':explanation' => $p['explanation'] ?? '',
    ':img'         => $p['img']         ?? '',
    ':atk'         => $p['atk']         ?? 0,
    ':def'         => $p['def']         ?? 0,
    ':spd'         => $p['spd']         ?? 0,
    ':hp'          => $p['hp']          ?? 0,
    ':mp'          => $p['mp']          ?? 0,
    ':skill1'      => $p['skill1']      ?? '',
    ':skill2'      => $p['skill2']      ?? '',
    ':skill3'      => $p['skill3']      ?? '',
    ':skill4'      => $p['skill4']      ?? '',
    ':skill5'      => $p['skill5']      ?? '',
    ':skill6'      => $p['skill6']      ?? '',
  ]);

  // セッションをクリア（ページリロードによる二重送信を防止）
  unset($_SESSION['register_params']);
  ?>
  <p>
    メンバーの登録が完了しました。
  </p>
  <p>
    <label for="name">ID：</label><?php echo $newId ?>
  </p>
  <p>
    <label for="name">名前：</label><?php echo htmlspecialchars($p['name'] ?? '') ?>
  </p>
  <p>
    <button type="button"><a href="/php/pages/member.php#<?php echo $newId ?>">メンバー画面に戻る</a></button>
  </p>
  <?php include('../common/footer.php'); ?>
</body>

</html>