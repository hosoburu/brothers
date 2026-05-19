# BROTHERS

ブラザーズと呼ばれるぬいぐるみ集団の公式サイトです。

> 開発ルール・コマンド等の技術情報は [CLAUDE.md](CLAUDE.md) を参照してください。

## ローカル開発の起動・停止

プロジェクトのルートディレクトリで以下のコマンドを実行する。

```bash
make start   # MySQL + PHPサーバーを同時起動
make stop    # MySQL + PHPサーバーを同時停止
```

起動後は http://localhost:8000 でサイトを確認できる。

> バッテリー消費が高いため、作業後は必ず `make stop` で停止すること。

## DB アクセス

`src/php/db/db.php` を include することで PDO 接続オブジェクト `$dbh` が使える。

```php
include('./db/db.php');

// 全件取得
$stmt = $dbh->query("SELECT * FROM t_user");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 条件指定（プレースホルダを使うこと）
$stmt = $dbh->prepare("SELECT * FROM t_user WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
```


## ターミナル操作（Mac）

ターミナルを閉じた後の再開手順:

1. `ls` で現在地のディレクトリを確認する
2. `cd Desktop` で Desktop に移動する
3. `cd brothers` でプロジェクトに移動する
4. `git status` で状態を確認する（modify や new が表示されればOK）
