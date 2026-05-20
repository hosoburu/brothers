<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ニュース投稿 入力画面</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/entry/form.css">
  <link rel="icon" href="/img/fabicon.ico">
</head>

<body>
  <?php require __DIR__ . '/../layout/header.php'; ?>
  <?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>

  <h2 class="heading-title">NEWS POST</h2>

  <div class="center">
    <form name="form1" method="post" action="/news/confirm.php">
      <input type="hidden" name="csrf_token" value="<?php echo $h($csrfToken); ?>">
      <table>
        <tr>
          <td><label for="name_id">メンバー：</label></td>
          <td>
            <select id="name_id" name="name_id">
              <option value="">-- 選択してください --</option>
              <?php foreach ($members as $member) { ?>
                <option value="<?php echo $h($member['id']); ?>"><?php echo $h($member['name']); ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="explanation">内容（プロンプト）：</label></td>
          <td>
            <textarea id="explanation" name="explanation" cols="30" rows="5" placeholder="例：ランキング機能を追加した。ATKやHPで順位が見られる。"></textarea>
            <small style="display:block;color:#888;margin-top:4px;">メモ書きで入力するとAIが文章に整えます</small>
          </td>
        </tr>
        <tr>
          <td><label for="hyperlink">リンク：</label></td>
          <td><input type="text" id="hyperlink" name="hyperlink" placeholder="https://..."></td>
        </tr>
        <tr>
          <td><label for="posted_date">日付：</label></td>
          <td><input type="date" id="posted_date" name="posted_date" value="<?php echo $h(date('Y-m-d')); ?>"></td>
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
