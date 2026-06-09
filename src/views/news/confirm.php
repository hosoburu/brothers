<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ニュース投稿 確認画面</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/entry/form.css">
  <link rel="icon" href="/img/fabicon.ico">
</head>

<body>
  <?php $pageTitle = "NEWS POST CONFIRM"; ?>
  <?php require __DIR__ . '/../layout/header.php'; ?>
  <?php $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); ?>

  <?php if ($errorFlg) { ?>
    <p>エラーがあります（メンバー・内容・日付は必須です）</p>
    <form name="form1" method="post" action="/news/confirm.php">
  <?php } else { ?>
    <form name="form1" method="post" action="/news/finish.php">
  <?php } ?>
    <input type="hidden" name="csrf_token" value="<?php echo $h($csrfToken); ?>">
    <table>
      <tr>
        <td><label>メンバー：</label></td>
        <td>
          <select name="name_id">
            <option value="">-- 選択してください --</option>
            <?php foreach ($members as $member) { ?>
              <option value="<?php echo $h($member['id']); ?>" <?php echo ((int) $member['id'] === $nameId) ? 'selected' : ''; ?>>
                <?php echo $h($member['name']); ?>
              </option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><label>内容：</label></td>
        <td><textarea name="explanation" cols="30" rows="5"><?php echo $h($explanation); ?></textarea></td>
      </tr>
      <tr>
        <td><label>リンク：</label></td>
        <td><input type="text" name="hyperlink" value="<?php echo $h($hyperlink); ?>"></td>
      </tr>
      <tr>
        <td><label>日付：</label></td>
        <td><input type="date" name="posted_date" value="<?php echo $h($postedDate); ?>"></td>
      </tr>
    </table>
    <input type="submit" value="投稿">
  </form>

  <button type="button" onclick="history.back()">戻る</button>

  <?php require __DIR__ . '/../layout/footer.php'; ?>
</body>

</html>
