<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>broters</title>
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/news.css">
  <link rel="icon" href="../img/fabicon.ico">
</head>

<?php include('./common/header.php'); ?>
<?php include('./db/db.php'); ?>
<?php
// SELECT文を変数に格納
$sql = "SELECT n.id, m.name, m.img, n.explanation, n.hyperlink, n.posted_date
  FROM t_news AS n 
  LEFT OUTER JOIN t_member as m 
  ON n.name_id = m.id  
  ORDER BY n.id";
// SQLステートメントを実行し、結果を変数に格納
$stmt = $dbh->query($sql);
?>
<section>
  <h2 class="heading-title">NEWS</h2>
  <ul class="top-list">
    <?php foreach ($stmt as $row) { ?>
      <li>
        <a href="<?php echo $row['hyperlink'] ?>">
          <img src="<?php echo $row['img'] ?>" alt="<?php echo $row['name'] ?>">
          <div class="top-list_info">
            <time><?php echo $row['posted_date'] ?></time>
            <p><?php echo $row['explanation'] ?></p>
          </div>
        </a>
      </li>
    <?php } ?>
  </ul>
</section>

<?php include('./common/footer.php'); ?>
</body>

</html>