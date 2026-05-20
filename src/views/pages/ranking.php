<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ランキング</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="icon" href="/img/fabicon.ico">
  <style>
    .ranking-nav { display: flex; gap: 8px; justify-content: center; margin: 16px 0; flex-wrap: wrap; }
    .ranking-nav a { padding: 6px 14px; border: 1px solid #ccc; border-radius: 4px; text-decoration: none; color: inherit; }
    .ranking-nav a.active { background: #333; color: #fff; border-color: #333; }
    .ranking-table { width: 90%; max-width: 600px; margin: 0 auto; border-collapse: collapse; }
    .ranking-table th, .ranking-table td { padding: 10px 14px; border: 1px solid #ddd; text-align: center; }
    .ranking-table th { background: #f5f5f5; }
    .ranking-table tr:nth-child(even) { background: #fafafa; }
    .rank-1 { font-weight: bold; color: #c8a000; }
    .rank-2 { font-weight: bold; color: #888; }
    .rank-3 { font-weight: bold; color: #a0522d; }
  </style>
</head>

<body>
  <?php require __DIR__ . '/../layout/header.php'; ?>
  <?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>

  <h2 class="heading-title">RANKING</h2>

  <nav class="ranking-nav">
    <?php foreach (['atk' => 'ATK', 'def' => 'DEF', 'spd' => 'SPD', 'hp' => 'HP', 'mp' => 'MP'] as $key => $label) { ?>
      <a href="/pages/ranking.php?stat=<?php echo $h($key); ?>"
         class="<?php echo ($stat === $key) ? 'active' : ''; ?>">
        <?php echo $h($label); ?>
      </a>
    <?php } ?>
  </nav>

  <table class="ranking-table">
    <thead>
      <tr>
        <th>順位</th>
        <th>名前</th>
        <th><?php echo $h(strtoupper($stat)); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($members as $i => $row) { ?>
        <?php $rank = $i + 1; ?>
        <tr>
          <td class="<?php echo $rank <= 3 ? 'rank-' . $rank : ''; ?>"><?php echo $h($rank); ?></td>
          <td><a href="/pages/member.php#<?php echo $h($row['id']); ?>"><?php echo $h($row['name']); ?></a></td>
          <td><?php echo $h($row[$stat]); ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
