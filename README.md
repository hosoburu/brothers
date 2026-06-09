# BROTHERS

ブラザーズと呼ばれるぬいぐるみ集団の公式サイトです。

> 開発ルール・コマンド等の技術情報は [CLAUDE.md](CLAUDE.md) を参照してください。

## 機能一覧

| 機能 | 概要 |
|------|------|
| メンバー登録 | 名前・画像・ステータス・スキル・口癖を登録（ログイン必須） |
| メンバー編集 | 既存メンバー情報の更新（ログイン必須） |
| ニュース投稿 | confirm → finish の2段階フロー。Gemini APIで文章を自動整形（ログイン必須） |
| ランキング | ステータス（ATK / DEF / SPD / HP / MP）別のメンバーランキング表示 |
| ログイン | `t_user` テーブルのアカウントで認証 |

### ログイン必須ページ

以下のページはログインしていない場合、ログインページにリダイレクトされる。

- メンバー登録（entry）
- メンバー編集（update）
- ニュース投稿（news）

## ローカル開発の起動・停止

プロジェクトのルートディレクトリで以下のコマンドを実行する。

```bash
make start   # MySQL + PHPサーバーを同時起動
make stop    # MySQL + PHPサーバーを同時停止
```

起動後は http://localhost:8000 でサイトを確認できる。

> バッテリー消費が高いため、作業後は必ず `make stop` で停止すること。

## 本番デプロイ

GitHub に push した後、以下のコマンドで本番サーバーに反映する。

```bash
make deploy
```

実行すると確認プロンプトが表示される（`y` で実行、それ以外はキャンセル）。

> 詳細な仕様は [CLAUDE.md](CLAUDE.md) を参照。

## DB テーブル一覧

| テーブル | 用途 |
|----------|------|
| `t_member` | メンバー情報（名前・画像・ステータス・スキル6つ・口癖） |
| `t_news` | ニュース投稿（投稿者ID・本文・リンク・投稿日） |
| `t_user` | ログインユーザー（名前・メールアドレス・パスワード） |
| `t_brothers` | サイト管理用の認証情報（id / pass） |

スキーマ定義は [`database/`](database/) 配下の `.sql` ファイルを参照。

## Gemini API 設定

ニュース投稿時にAIが文章を自動整形する機能で使用する。`.env` に以下を追加する。

```
GEMINI_API_KEY=your_api_key_here
```

APIキーは [Google AI Studio](https://aistudio.google.com/) で取得できる。キーが未設定の場合はAI整形をスキップし、入力テキストをそのまま使用する。

## DB アクセス

`src/models/Database.php` の `Database::connect()` で PDO 接続オブジェクトを取得する（シングルトン）。
Model クラス内で使う想定のため、直接呼び出しは Model に書くこと。

```php
require_once __DIR__ . '/Database.php';

$db = Database::connect();

// 全件取得
$rows = $db->query("SELECT * FROM t_member ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

// 条件指定（プレースホルダを使うこと）
$stmt = $db->prepare("SELECT * FROM t_member WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
```


## 本番DB操作

SSH でサーバーにログインし、MySQL に接続して操作する。
接続情報は `.env.production` を参照。

接続情報はすべて `.env` / `.env.production` を参照し、以下の変数を実際の値に置き換えて実行する。

| 変数 | 参照ファイル | 内容 |
|------|-------------|------|
| `DEPLOY_USER` | `.env` | SSHユーザー名 |
| `DEPLOY_HOST` | `.env` | サーバーホスト名 |
| `DEPLOY_PORT` | `.env` | SSHポート番号 |
| `DEPLOY_KEY` | `.env` | SSH秘密鍵パス |
| `DB_USER` | `.env.production` | MySQLユーザー名 |
| `DB_PASS` | `.env.production` | MySQLパスワード |
| `DB_NAME` | `.env.production` | データベース名 |

### MySQL に接続する

```bash
ssh <DEPLOY_USER>@<DEPLOY_HOST> -p <DEPLOY_PORT> -i <DEPLOY_KEY> \
  "mysql -u <DB_USER> -p'<DB_PASS>' <DB_NAME>"
```

### SQL を1行実行する（例：カラム追加）

```bash
ssh <DEPLOY_USER>@<DEPLOY_HOST> -p <DEPLOY_PORT> -i <DEPLOY_KEY> \
  "mysql -u <DB_USER> -p'<DB_PASS>' <DB_NAME> -e \"ALTER TABLE t_member ADD COLUMN catchphrase char(255) DEFAULT NULL;\""
```

### テーブル定義を確認する

```bash
ssh <DEPLOY_USER>@<DEPLOY_HOST> -p <DEPLOY_PORT> -i <DEPLOY_KEY> \
  "mysql -u <DB_USER> -p'<DB_PASS>' <DB_NAME> -e \"DESCRIBE t_member;\""
```

> カラムを追加したら `database/` 配下の対応する `.sql` ファイルも更新すること。

## ターミナル操作（Mac）

ターミナルを閉じた後の再開手順:

1. `ls` で現在地のディレクトリを確認する
2. `cd Desktop` で Desktop に移動する
3. `cd brothers` でプロジェクトに移動する
4. `git status` で状態を確認する（modify や new が表示されればOK）
