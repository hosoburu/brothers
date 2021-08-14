<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー登録 入力画面</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/member.css">
  <link rel="stylesheet" href="../css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="../img/fabicon.ico">
</head>

<body>
  <?php include('./common/header.php'); ?>

  <form name="form1" method="post" action="registerConfirm.php">
    <table>
      <tr>
        <td><label for="name">ID：</label></td>
        <td><input type="text" name="id"></td>
      </tr>
      <tr>
        <td> <label for="name">名前：</label></td>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <td><label for="name">説明：</label></td>
        <td><textarea name="explanation" cols="30" rows="5"></textarea></td>
      </tr>
      <tr>
        <td><label for="name">ATK：</label></td>
        <td><input type="text" name="atk"></td>
      </tr>
      <tr>
        <td> <label for="name">DEF：</label></td>
        <td><input type="text" name="def"></td>
      </tr>
      <tr>
        <td> <label for="name">SPD：</label></td>
        <td><input type="text" name="spd"></td>
      </tr>
      <tr>
        <td> <label for="name">HP：</label></td>
        <td><input type="text" name="hp"></td>
      </tr>
      <tr>
        <td> <label for="name">MP：</label></td>
        <td><input type="text" name="mp"></td>
      </tr>
      <tr>
        <td> <label for="name">スキル1：</label></td>
        <td><input type="text" name="skill1"></td>
      </tr>
      <tr>
        <td> <label for="name">スキル2：</label></td>
        <td><input type="text" name="skill2"></td>
      </tr>
      <tr>
        <td> <label for="name">スキル3：</label></td>
        <td><input type="text" name="skill3"></td>
      </tr>
      <tr>
        <td> <label for="name">スキル4：</label></td>
        <td><input type="text" name="skill4"></td>
      </tr>
      <tr>
        <td> <label for="name">スキル5：</label></td>
        <td><input type="text" name="skill5"></td>
      </tr>
      <tr>
        <td> <label for="name">スキル6：</label></td>
        <td><input type="text" name="skill6"></td>
      </tr>
    </table>
    <input type="submit" value="確認">
  </form>

  <?php include('./common/footer.php'); ?>
</body>

</html>