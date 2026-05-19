<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー更新 入力画面</title>
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/register/form.css">
  <link rel="stylesheet" href="../css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="../img/fabicon.ico">
</head>

<body>
  <?php include('./common/header.php'); ?>
  <h2 class="heading-title">UPDATE</h2>
  <?php include('./db/db.php'); ?>

  <?php
  //セッションを開始
  session_start();
  //idをセッションに格納
  $_SESSION['id'] = $_POST["id"];

  ?>

  <?php
  $id = $_SESSION['id'];

  // SELECT文を変数に格納
  $sql = "SELECT * FROM t_member WHERE id=$id";
  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $dbh->query($sql);

  $name;
  $explanation;
  // $img;
  $atk;
  $def;
  $spd;
  $hp;
  $mp;
  $skill1;
  $skill2;
  $skill3;
  $skill4;
  $skill5;
  $skill6;

  ?>

  <?php foreach ($stmt as $row) { ?>
    <?php $name = $row['name'] ?>
    <?php $explanation = $row['explanation'] ?>
    <?php $atk = $row['atk'] ?>
    <?php $def = $row['def'] ?>
    <?php $spd = $row['spd'] ?>
    <?php $hp = $row['hp'] ?>
    <?php $mp = $row['mp'] ?>
    <?php $skill1 = $row['skill1'] ?>
    <?php $skill2 = $row['skill2'] ?>
    <?php $skill3 = $row['skill3'] ?>
    <?php $skill4 = $row['skill4'] ?>
    <?php $skill5 = $row['skill5'] ?>
    <?php $skill6 = $row['skill6'] ?>
  <?php } ?>

  <div class="center">
    <form name="form1" method="post" action="updateConfirm.php">
      <table>
        <!-- <tr>
          <td><label for="name">ID：</label></td>
          <td><input disabled type="text" name="id" value="<?php echo $max_id + 1 ?>">
          </td>
        </tr> -->
        <tr>
          <td> <label for="name">名前：</label></td>
          <td><input type="text" name="name" value="<?php echo $name ?>"></td>
        </tr>
        <tr>
          <td><label for="name">説明：</label></td>
          <td><textarea name="explanation" cols="30" rows="5"><?php echo $explanation ?></textarea></td>
        </tr>
        <!-- <tr>
          <td> <label for="name">画像：</label></td>
          <td><input type="text" name="img"></td>
        </tr> -->
        <tr>
          <td><label for="name">ATK：</label></td>
          <td><input type="text" name="atk" value="<?php echo $atk ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">DEF：</label></td>
          <td><input type="text" name="def" value="<?php echo $def ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">SPD：</label></td>
          <td><input type="text" name="spd" value="<?php echo $spd ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">HP：</label></td>
          <td><input type="text" name="hp" value="<?php echo $hp ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">MP：</label></td>
          <td><input type="text" name="mp" value="<?php echo $mp ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル1：</label></td>
          <td><input type="text" name="skill1" value="<?php echo $skill1 ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル2：</label></td>
          <td><input type="text" name="skill2" value="<?php echo $skill2 ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル3：</label></td>
          <td><input type="text" name="skill3" value="<?php echo $skill3 ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル4：</label></td>
          <td><input type="text" name="skill4" value="<?php echo $skill4 ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル5：</label></td>
          <td><input type="text" name="skill5" value="<?php echo $skill5 ?>"></td>
        </tr>
        <tr>
          <td> <label for="name">スキル6：</label></td>
          <td><input type="text" name="skill6" value="<?php echo $skill6 ?>"></td>
        </tr>
      </table>
      <div class="test">
        <input type="submit" value="確認">
      </div>
    </form>
  </div>

  <?php include('./common/footer.php'); ?>
</body>

</html>