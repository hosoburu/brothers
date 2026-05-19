<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー更新 完了画面</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/member.css">
  <link rel="stylesheet" href="/css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="/img/fabicon.ico">
</head>

<body>
  <?php require __DIR__ . '/../layout/header.php'; ?>
  <h2 class="heading-title">UPDATE COMPLETION</h2>

  <?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>
  <p>メンバーの更新が完了しました。</p>
  <p><label>ID：</label><?php echo $h($id) ?></p>
  <p><label>名前：</label><?php echo $h($name) ?></p>
  <p>
    <button type="button"><a href="/pages/member.php#<?php echo $h($id) ?>">メンバー画面に戻る</a></button>
  </p>
  <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
