<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー登録 確認画面</title>
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/member.css">
  <link rel="stylesheet" href="../css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="../img/fabicon.ico">
</head>

<body>
  <?php include('./common/header.php'); ?>
  <h2 class="heading-title">RECRUITMENT CONFIRM</h2>
  <?php include('./db/db.php'); ?>


  <?php
  //セッションを開始
  session_start();
  ?>

  <?php

  //登録に必要なパラメータを準備
  $id = $_POST["id"];
  $name = $_POST["name"];
  $explanation = $_POST["explanation"];
  $img = $_POST["img"];
  $atk = $_POST["atk"];
  $def = $_POST["def"];
  $spd = $_POST["spd"];
  $hp = $_POST["hp"];
  $mp = $_POST["mp"];
  $skill1 = $_POST["skill1"];
  $skill2 = $_POST["skill2"];
  $skill3 = $_POST["skill3"];
  $skill4 = $_POST["skill4"];
  $skill5 = $_POST["skill5"];
  $skill6 = $_POST["skill6"];

  // INSERT文を変数に格納
  $sql = "INSERT INTO t_member (id, name, explanation, img, atk, def, spd, hp, mp, skill1, skill2, skill3, skill4, skill5, skill6)
  VALUES($id, '$name', '$explanation','$img', $atk, $def, $spd, $hp, $mp, '$skill1', '$skill2', '$skill3', '$skill4', '$skill5', '$skill6')";
  //SQLをセッションに格納
  $_SESSION['sql'] = $sql;
  ?>

  <?php
  //なぜか整数チェックが効かない
  // if (is_int($_POST["id"])) {
  //   echo "IDは半角数字で入力してください";
  // }

  $errorFlg = false;

  if (empty($_POST["id"])) {
    $errorFlg = true;
  }
  if (empty($_POST["name"])) {
    $errorFlg = true;
  }
  if (empty($_POST["atk"])) {
    $errorFlg = true;
  }
  if (empty($_POST["def"])) {
    $errorFlg = true;
  }
  if (empty($_POST["spd"])) {
    $errorFlg = true;
  }
  if (empty($_POST["hp"])) {
    $errorFlg = true;
  }
  if (empty($_POST["mp"])) {
    $errorFlg = true;
  }
  if (empty($_POST["skill1"])) {
    $errorFlg = true;
  }
  ?>

  <?php if ($errorFlg) {
    echo "エラーがあります";
  ?>
    <form name="form1" method="post" action="registerConfirm.php">
    <?php
  } else {
    ?>
      <form name="form1" method="post" action="registerFinish.php">
      <?php
    }
      ?>

      <table>
        <tr>
          <td><label for="name">ID：</label></td>
          <td><input type="text" name="id" value="<?php echo $_POST["id"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">名前：</label></td>
          <td><input type="text" name="name" value="<?php echo $_POST["name"] ?>"></td>
        </tr>
        <tr>
          <td><label for="name">説明：</label></td>
          <td><textarea name="explanation" cols="30" rows="5"><?php echo $_POST["explanation"] ?></textarea></td>
        </tr>
        <tr>
          <td> <label for="name">画像：</label></td>
          <td><input type="text" name="img" value="<?php echo $_POST["img"] ?>"></td>
        </tr>
        <tr>
          <td><label for="name">ATK：</label></td>
          <td><input type="text" name="atk" value="<?php echo $_POST["atk"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">DEF：</label></td>
          <td><input type="text" name="def" value="<?php echo $_POST["def"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">SPD：</label></td>
          <td><input type="text" name="spd" value="<?php echo $_POST["spd"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">HP：</label></td>
          <td><input type="text" name="hp" value="<?php echo $_POST["hp"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">MP：</label></td>
          <td><input type="text" name="mp" value="<?php echo $_POST["mp"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル1：</label></td>
          <td><input type="text" name="skill1" value="<?php echo $_POST["skill1"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル2：</label></td>
          <td><input type="text" name="skill2" value="<?php echo $_POST["skill2"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル3：</label></td>
          <td><input type="text" name="skill3" value="<?php echo $_POST["skill3"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル4：</label></td>
          <td><input type="text" name="skill4" value="<?php echo $_POST["skill4"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル5：</label></td>
          <td><input type="text" name="skill5" value="<?php echo $_POST["skill5"] ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル6：</label></td>
          <td><input type="text" name="skill6" value="<?php echo $_POST["skill6"] ?>"></td>
        </tr>
      </table>
      <input type="submit" value="登録">
      </form>

      <button type="button" onclick=history.back()>戻る</button>


      <?php include('./common/footer.php'); ?>
</body>

</html>