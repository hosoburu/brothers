<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー登録 入力画面</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/entry/form.css">
  <link rel="stylesheet" href="/css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="/img/fabicon.ico">
</head>

<body>
  <?php $pageTitle = "RECRUITMENT"; ?>
  <?php require __DIR__ . '/../layout/header.php'; ?>

  <div class="center">
    <form name="form1" method="post" action="/entry/confirm.php">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
      <table>
        <tr>
          <td><label for="id">ID：</label></td>
          <td><input readonly type="text" id="id" name="id" value="<?php echo htmlspecialchars((string) ($maxId + 1), ENT_QUOTES, 'UTF-8') ?>"></td>
        </tr>
        <tr>
          <td><label for="name">名前：</label></td>
          <td><input type="text" id="name" name="name"></td>
        </tr>
        <tr>
          <td><label for="explanation">説明：</label></td>
          <td><textarea id="explanation" name="explanation" cols="30" rows="5"></textarea></td>
        </tr>
        <tr>
          <td><label for="img">画像：</label></td>
          <td><input type="text" id="img" name="img" placeholder="/img/filename.jpg"></td>
        </tr>
        <tr>
          <td><label for="atk">ATK：</label></td>
          <td><input type="number" id="atk" name="atk"></td>
        </tr>
        <tr>
          <td><label for="def">DEF：</label></td>
          <td><input type="number" id="def" name="def"></td>
        </tr>
        <tr>
          <td><label for="spd">SPD：</label></td>
          <td><input type="number" id="spd" name="spd"></td>
        </tr>
        <tr>
          <td><label for="hp">HP：</label></td>
          <td><input type="number" id="hp" name="hp"></td>
        </tr>
        <tr>
          <td><label for="mp">MP：</label></td>
          <td><input type="number" id="mp" name="mp"></td>
        </tr>
        <tr>
          <td><label for="skill1">スキル1：</label></td>
          <td><input type="text" id="skill1" name="skill1"></td>
        </tr>
        <tr>
          <td><label for="skill2">スキル2：</label></td>
          <td><input type="text" id="skill2" name="skill2"></td>
        </tr>
        <tr>
          <td><label for="skill3">スキル3：</label></td>
          <td><input type="text" id="skill3" name="skill3"></td>
        </tr>
        <tr>
          <td><label for="skill4">スキル4：</label></td>
          <td><input type="text" id="skill4" name="skill4"></td>
        </tr>
        <tr>
          <td><label for="skill5">スキル5：</label></td>
          <td><input type="text" id="skill5" name="skill5"></td>
        </tr>
        <tr>
          <td><label for="skill6">スキル6：</label></td>
          <td><input type="text" id="skill6" name="skill6"></td>
        </tr>
        <tr>
          <td><label for="catchphrase">口癖（語尾）：</label></td>
          <td><input type="text" id="catchphrase" name="catchphrase" placeholder="例：バラ"></td>
        </tr>
      </table>
      <div class="test">
        <input type="submit" value="確認" <?php echo isset($_SESSION['name']) ? '' : 'disabled'; ?>>
      </div>
    </form>
  </div>

  <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
