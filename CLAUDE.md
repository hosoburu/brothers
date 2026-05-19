# BROTHERS

> このファイルはClaude Code（AI）向けのプロジェクト情報です。

## プロジェクトの概要

ブラザーズと呼ばれるぬいぐるみ集団の公式サイトプロジェクト

## 技術スタック

- フロントエンド: HTML / CSS / JavaScript（Slickスライダー）
- バックエンド: PHP
- データベース: MySQL
- フレームワーク: なし

## 開発ルール

- コメントとドキュメントは日本語で記述する

## ディレクトリ構成

MVC構成を採用。ロジック・DB操作・表示を分離している。

```
brothers/
├── public/              # ドキュメントルート（Webから公開）
│   ├── index.php        # エントリーポイント（コントローラー呼び出しのみ）
│   ├── css/             # スタイルシート（スマホ対応含む）
│   ├── img/             # 画像素材
│   ├── js/              # JavaScript
│   ├── auth/            # 認証エントリーポイント（ログイン・会員登録）
│   ├── entry/           # 団員登録エントリーポイント
│   ├── pages/           # 各ページエントリーポイント
│   └── update/          # メンバー更新エントリーポイント
├── src/                 # PHPロジック（Webから直接アクセス不可）
│   ├── config/          # 設定ファイル
│   │   └── database.php # DB接続設定（環境自動判定）
│   ├── models/          # モデル（DB操作）
│   │   ├── Database.php # PDO接続シングルトン
│   │   ├── UserModel.php
│   │   ├── MemberModel.php
│   │   └── NewsModel.php
│   ├── controllers/     # コントローラー（リクエスト処理・ロジック）
│   │   ├── AuthController.php
│   │   ├── EntryController.php
│   │   ├── PageController.php
│   │   └── UpdateController.php
│   ├── views/           # ビュー（HTMLテンプレート）
│   │   ├── layout/      # 共通レイアウト（header / footer）
│   │   ├── auth/        # 認証ビュー
│   │   ├── entry/       # 団員登録ビュー
│   │   ├── pages/       # 各ページビュー
│   │   └── update/      # メンバー更新ビュー
│   └── common/          # 共通処理
│       └── security/    # セッション検証
└── database/            # SQLマイグレーション
```

## サーバー起動コマンド

Makefile で MySQL と PHP サーバーをまとめて起動・停止できる。

```bash
make start   # MySQL + PHPサーバーを同時起動 → http://localhost:8000
make stop    # MySQL + PHPサーバーを同時停止
```

個別に操作する場合:

```bash
# MySQL
mysql.server start   # 起動
mysql.server stop    # 停止
mysql -uroot         # ログイン

# PHPサーバー
php -S localhost:8000 -t public &  # バックグラウンド起動
pkill -f "php -S"        # 停止
```

## Gitワークフロー

```bash
git status           # 修正・変更内容の確認
git add ファイル名   # ステージングに追加（例: git add style.css）
git add --all        # 編集したファイルをすべて追加
git pull origin develop   # リモートブランチを取得（pushの前に実行）
git push origin develop   # リモートに反映
```

## エラー対処

### git pull できない（MERGE_HEAD exists エラー）

```
error: You have not concluded your merge (MERGE_HEAD exists).
hint: Please, commit your changes before merging.
```

`git status` で赤色のファイル（addしていないファイル）がないか確認し、あればコミットしてから `git pull` を実行する。
