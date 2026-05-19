<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>broters</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/news.css">
  <link rel="icon" href="/img/fabicon.ico">
</head>

<body>
<?php require __DIR__ . '/../layout/header.php'; ?>
<?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>
<section>
  <h2 class="heading-title">NEWS</h2>
  <ul class="top-list">
    <?php foreach ($newsList as $row) { ?>
      <li>
        <a href="<?php echo $h($row['hyperlink']) ?>">
          <img src="<?php echo $h($row['img']) ?>" alt="<?php echo $h($row['name']) ?>">
          <div class="top-list_info">
            <time><?php echo $h($row['posted_date']) ?></time>
            <p><?php echo $h($row['explanation']) ?></p>
          </div>
        </a>
      </li>
    <?php } ?>
  </ul>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
