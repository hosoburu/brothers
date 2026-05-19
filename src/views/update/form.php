<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー更新 入力画面</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/entry/form.css">
  <link rel="stylesheet" href="/css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="/img/fabicon.ico">
</head>

<body>
  <?php require __DIR__ . '/../layout/header.php'; ?>
  <h2 class="heading-title">UPDATE</h2>
  <?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>

  <div class="center">
    <form name="form1" method="post" action="/update/confirm.php">
      <input type="hidden" name="csrf_token" value="<?php echo $h($csrfToken); ?>">
      <table>
        <tr>
          <td><label>名前：</label></td>
          <td><input type="text" name="name" value="<?php echo $h($name) ?>"></td>
        </tr>
        <tr>
          <td><label>説明：</label></td>
          <td><textarea name="explanation" cols="30" rows="5"><?php echo $h($explanation) ?></textarea></td>
        </tr>
        <tr>
          <td><label>ATK：</label></td>
          <td><input type="text" name="atk" value="<?php echo $h($atk) ?>"></td>
        </tr>
        <tr>
          <td><label>DEF：</label></td>
          <td><input type="text" name="def" value="<?php echo $h($def) ?>"></td>
        </tr>
        <tr>
          <td><label>SPD：</label></td>
          <td><input type="text" name="spd" value="<?php echo $h($spd) ?>"></td>
        </tr>
        <tr>
          <td><label>HP：</label></td>
          <td><input type="text" name="hp" value="<?php echo $h($hp) ?>"></td>
        </tr>
        <tr>
          <td><label>MP：</label></td>
          <td><input type="text" name="mp" value="<?php echo $h($mp) ?>"></td>
        </tr>
        <tr>
          <td><label>スキル1：</label></td>
          <td><input type="text" name="skill1" value="<?php echo $h($skill1) ?>"></td>
        </tr>
        <tr>
          <td><label>スキル2：</label></td>
          <td><input type="text" name="skill2" value="<?php echo $h($skill2) ?>"></td>
        </tr>
        <tr>
          <td><label>スキル3：</label></td>
          <td><input type="text" name="skill3" value="<?php echo $h($skill3) ?>"></td>
        </tr>
        <tr>
          <td><label>スキル4：</label></td>
          <td><input type="text" name="skill4" value="<?php echo $h($skill4) ?>"></td>
        </tr>
        <tr>
          <td><label>スキル5：</label></td>
          <td><input type="text" name="skill5" value="<?php echo $h($skill5) ?>"></td>
        </tr>
        <tr>
          <td><label>スキル6：</label></td>
          <td><input type="text" name="skill6" value="<?php echo $h($skill6) ?>"></td>
        </tr>
      </table>
      <div class="test">
        <input type="submit" value="確認">
      </div>
    </form>
  </div>

  <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
