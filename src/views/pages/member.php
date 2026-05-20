<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>broters</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/member.css">
  <link rel="stylesheet" href="/css/spc.css" type="text/css" media="screen and (max-width: 375px)">
  <link rel="icon" href="/img/fabicon.ico">
  <!-- ポップアップ用のソース -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>

<body>
  <?php require __DIR__ . '/../layout/header.php'; ?>
  <?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>
  <h2 class="heading-title">MEMBER LIST</h2>
  <div class="member-area">
    <?php foreach ($members as $row) { ?>
      <section id="info" class="info-area">
        <div class="inner info-content">
          <div class="info-text">
            <h1 id="<?php echo $h($row['id']) ?>">No.<?php echo $h($row['id']) ?> <?php echo $h($row['name']) ?> </h1>
            <p><?php echo $h($row['explanation']) ?></p>
            <?php if (!empty($row['catchphrase'])) { ?>
              <p class="catchphrase">口癖：〜<?php echo $h($row['catchphrase']) ?></p>
            <?php } ?>
          </div>
          <div class="container">
            <div>
              <a href="<?php echo $h($row['img']) ?>" data-lightbox="group"><img src="<?php echo $h($row['img']) ?>" width="400" alt="<?php echo $h($row['name']) ?>の画像"></a>
            </div>
            <table>
              <tr>
                <th class="col-1">ATK</th>
                <td><?php echo $h($row['atk']) ?></td>
              </tr>
              <tr>
                <th class="col-2">DEF</th>
                <td><?php echo $h($row['def']) ?></td>
              </tr>
              <tr>
                <th class="col-3"> SPD</th>
                <td><?php echo $h($row['spd']) ?></td>
              </tr>
              <tr>
                <th class="col-4">HP</th>
                <td><?php echo $h($row['hp']) ?></td>
              </tr>
              <tr>
                <th class="col-5">MP</th>
                <td><?php echo $h($row['mp']) ?></td>
              </tr>
            </table>
          </div>

          <table class="skill">
            <tr>
              <th class="skill" colspan="2"> スキル</th>
            </tr>
            <td><?php echo $h($row['skill1']) ?></td>
            <tr>
              <td><?php echo $h($row['skill2']) ?></td>
            </tr>
            <tr>
              <td><?php echo $h($row['skill3']) ?></td>
            </tr>
            <tr>
              <td><?php echo $h($row['skill4']) ?></td>
            </tr>
            <tr>
              <td><?php echo $h($row['skill5']) ?></td>
            </tr>
            <tr>
              <td><?php echo $h($row['skill6']) ?></td>
            </tr>
          </table>
          <form name="form1" method="post" action="/update/form.php">
            <input type="hidden" name="id" value="<?php echo $h($row['id']) ?>">
            <p>
              <input type="submit" value="情報更新">
            </p>
          </form>
        </div>
      </section>
    <?php } ?>
  </div>
  <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
