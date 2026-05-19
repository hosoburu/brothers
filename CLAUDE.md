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

- php/ : PHPバックエンド（ページ・認証・DB接続）
- css/ : スタイルシート（スマホ対応含む）
- js/ : JavaScript
- img/ : 画像素材
- common/ : 共通HTML（header / footer）

## サーバー起動コマンド

```bash
# MySQL
mysql.server start   # 起動
mysql.server stop    # 停止
mysql -uroot         # ログイン

# PHPサーバー（組み込みサーバーで起動する場合）
php -S localhost:8000
pkill -f "php -S"    # 停止
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
