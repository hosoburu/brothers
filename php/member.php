<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>broters</title>
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/member.css">
  <link rel="stylesheet" href="../css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="../img/fabicon.ico">
  <!-- ポップアップ用のソース -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>

<body>
  <?php include('./common/header.php'); ?>
  <h2 class="heading-title">MEMBER LIST</h2>
  <?php include('./db/db.php'); ?>
  <?php
  // SELECT文を変数に格納
  $sql = "SELECT * FROM t_member ORDER BY id";
  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $dbh->query($sql);
  ?>
  <div class="member-area">
    <?php foreach ($stmt as $row) { ?>
      <section id="info" class="info-area">
        <div class="inner info-content">
          <div class="info-text">
            <h1>No.<?php echo $row['id'] ?> <?php echo $row['name'] ?> </h1>
            <p><?php echo $row['explanation'] ?></p>
          </div>
          <div class="container">
            <div>
              <a href="<?php echo $row['img'] ?>" data-lightbox="group"><img src="<?php echo $row['img'] ?>" width="400" alt="<?php echo $row['name'] ?>の画像"></a>
            </div>
            <table>
              <tr>
                <th class="col-1">ATK</th>
                <td><?php echo $row['atk'] ?></td>
              </tr>
              <tr>
                <th class="col-2">DFE</th>
                <td><?php echo $row['def'] ?></td>
              </tr>
              <tr>
                <th class="col-3"> SPD</th>
                <td><?php echo $row['spd'] ?></td>
              </tr>
              <tr>
                <th class="col-4">HP</th>
                <td><?php echo $row['hp'] ?></td>
              </tr>
              <tr>
                <th class="col-5">MP</th>
                <td><?php echo $row['mp'] ?></td>
              </tr>
            </table>
          </div>

          <table class="skill">

            <tr>
              <th class="skill" colspan="2"> スキル</th>
            </tr>
            <td><?php echo $row['skill1'] ?></td>
            <tr>
              <td><?php echo $row['skill2'] ?></td>
            </tr>
            <tr>
              <td><?php echo $row['skill3'] ?></td>
            </tr>
            <tr>
              <td><?php echo $row['skill4'] ?></td>
            </tr>
            <tr>
              <td><?php echo $row['skill5'] ?></td>
            </tr>
            <tr>
              <td><?php echo $row['skill6'] ?></td>
            </tr>
          </table>
      </section>
    <?php } ?>
  </div>
  <?php include('./common/footer.php'); ?>
</body>

</html>