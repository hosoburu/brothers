# BROTHERS — Claude Code 開発ガードレール v2

> このファイルはClaude Code（AI）向けの開発ガードレールです。
> 「今のプロジェクトを壊さず育てる」を最優先とし、過剰設計・一般論を禁じます。

---

## 現在のアーキテクチャ（実態）

```
public/xxx.php（エントリーポイント・1〜3行のみ）
  └── require Controller
        ├── Model（DB操作）
        └── require View（HTMLテンプレート）
```

- **Service層は現時点で存在しない**。Controller が Model を直接呼ぶ構成。
- Controllerのローカル変数を `require` 直前にセットすることで View に渡す（スコープ共有）。
- confirm → finish フローは `$_SESSION` 経由でパラメータを引き継ぐ多段フォームパターン。
- セッション検証は `src/common/security/security_core.php` が担う（DBと照合）。

---

## P0 — 絶対ルール（違反禁止）

### 1. 責務境界

#### Controller（`src/controllers/`）

**やること：**
- `$_POST` / `$_GET` / `$_SESSION` からパラメータ受け取り
- Model呼び出し → `require` 直前でローカル変数にセット → View 表示
- リダイレクト・HTTPレスポンス制御

**禁止：**
- SQL文を書く（必ずModelに移す）
- 複雑な条件分岐・計算ロジック（既存 `AuthController::register()` の2段階バリデーション程度は許容。複数テーブルをまたぐ更新・Controller が50行を超えたらService検討）
- View内容のHTML生成

#### Model（`src/models/`）

**やること：**
- PDO経由のSQL実行のみ
- `Database::connect()` を使う（直接PDO接続を書かない）

**禁止：**
- ビジネスロジック（判定・計算・バリデーション）
- `$_POST` / `$_SESSION` への直接アクセス

#### View（`src/views/`）

**やること：**
- Controller から渡されたローカル変数の表示
- `require layout/header.php` / `require layout/footer.php`
- **出力は必ず `htmlspecialchars($value, ENT_QUOTES, 'UTF-8')` でエスケープする**

**禁止：**
- DB接続・SQL実行
- `$_POST` の直接参照（Controller がローカル変数として渡す）
- 業務ロジック・計算

#### security_core.php（`src/common/security/`）

- **現状の特殊ファイル**：Modelを介さずDBに直接アクセスしている。
- 今後の変更では**触れない**。必要なら UserModel に責務を移す方向で提案する。

---

### 2. セキュリティ必須要件

**XSS 対策（View の全出力に適用）：**

```php
// 全ての動的出力に適用。省略禁止。
echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
```

現状、Views 全体でエスケープが省略されている。新規追加・既存修正の際は**必ずエスケープを付ける**。触ったファイルのエスケープ漏れは合わせて修正する。

**ID 改ざんリスク（UpdateController::showForm）：**

[src/controllers/UpdateController.php:15](src/controllers/UpdateController.php#L15) で `$_SESSION['id'] = $_POST['id'] ?? $_SESSION['id'] ?? null` を行っている。ログイン済みの任意ユーザーが他人の id を POST で送ることで他人のメンバー情報を上書きできる。このファイルを触る際は**必ずこのリスクを確認・報告すること**。

**SQL インジェクション対策：**
SQL は必ず PDO プリペアドステートメントで書く（現行パターン維持）。

---

### 3. 実装前チェック（中規模以上の変更時）

**中規模の定義：2ファイル以上、または auth / entry / update など複数フローをまたぐ変更。**

以下を **実装前に提示**：

1. 変更するファイル一覧
2. 影響を受けるページ・フロー
3. セッション・DB・Viewへの波及リスク

**小規模（1ファイル・既存関数の修正のみ）は省略可。**

勝手な大規模リファクタ禁止。「ついでに整理」もしない。

---

### 4. 最小変更原則

- 既存構造を尊重し、最小の変更で目的を達成する。
- ただし以下のケースは設計改善案を提示（実施は確認後）：
  - Controller に SQL が書かれている
  - View に DB アクセスが入っている

「最小変更」を理由に既知のセキュリティリスクを温存しない。

---

### 5. Makefile 優先

既存コマンドを使う：

| コマンド | 用途 |
|----------|------|
| `make start` | MySQL + PHPサーバー起動 + ブラウザ起動 |
| `make stop` | 全停止 |
| `make deploy` | 本番デプロイ（確認プロンプトあり） |

独自コマンドを Makefile に追加する場合は理由を説明する。

---

### 6. 既存ディレクトリ構成の尊重

新規ファイル追加時のルール：

| 追加先 | 条件 |
|--------|------|
| `src/controllers/` | 新規フロー（ページ群）を追加する時 |
| `src/models/` | 新規テーブルを扱う時 |
| `src/views/` | 対応する Controller と同じサブディレクトリに配置 |
| `public/` | エントリーポイント（1〜3行）のみ |
| `src/services/` | Controller が50行超 または 複数テーブルをまたぐ更新が必要な時のみ（現時点は作らない） |

命名規則：`XxxController.php` / `XxxModel.php` / キャメルケース統一。

---

## P1 — 原則（守る、理由があれば相談）

### コーディング

- バリデーション（`$errorFlg`）は Controller に書く（現行パターンを踏襲）
- マジックナンバー禁止（スキル数 `6` は定数化を提案）
- ネスト3段以上は早期returnで解消する
- `$_POST` からの大量抽出が新規追加で増える場合、配列まとめを提案する

### 説明義務

修正時は以下を簡潔に提示：
- なぜこの実装にしたか
- 既存機能への影響範囲
- 将来的なリスクがあれば一言

リファクタリングと機能追加を**同一コミットに混ぜない**。

---

## P2 — 推奨（聞かれた時・明らかな場合のみ）

- Service層新設の提案（Controller が50行超 または 複数テーブルをまたぐ更新が発生した時）
- CSRF対策の導入提案（新規フォームを追加する時）
- `htmlspecialchars` のヘルパー関数化（エスケープ漏れが繰り返し発生した時）

**現時点で不要な設計変更はしない。**

---

## デプロイ注意事項

- `.env` / `.env.production` はコミット対象外（`.gitignore` 管理済み）
- 本番デプロイは `make deploy` のみ（直接 SSH コマンドを組み立てない）
- LittleServer は `git pull` 不可のため、develop ブランチ削除→再チェックアウト方式（Makefile で自動化済み）

---

## 禁止事項まとめ

| 禁止 | 理由 |
|------|------|
| View で DB アクセス | MVC 責務違反 |
| Controller に SQL 直書き | Model の意味がなくなる |
| View でエスケープ省略 | XSS リスク |
| 確認なしの大規模リファクタ | 動いているコードを壊すリスク |
| Service / Repository / Interface の先行導入 | 現規模では過剰設計 |
| `.env` のコミット | 本番DB認証情報漏洩 |
| `make deploy` 以外のデプロイ手順 | 手順の一貫性維持 |
