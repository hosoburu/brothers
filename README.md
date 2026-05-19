# BROTHERS

ブラザーズと呼ばれるぬいぐるみ集団の公式サイトです。

> 開発ルール・コマンド等の技術情報は [CLAUDE.md](CLAUDE.md) を参照してください。

## セットアップ

### MySQL の起動・停止

バッテリー消費が高いため、使用後は必ず停止すること。

```bash
mysql.server start  # 起動
mysql.server stop   # 停止
```

## ターミナル操作（Mac）

ターミナルを閉じた後の再開手順:

1. `ls` で現在地のディレクトリを確認する
2. `cd Desktop` で Desktop に移動する
3. `cd brothers` でプロジェクトに移動する
4. `git status` で状態を確認する（modify や new が表示されればOK）
