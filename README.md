brothers
Git操作編

① status・・・修正・変更内容の確認

② add・・・commitする前に行うコマンド git add ファイル名～　例えばCSSとかstyle.cssとか git add --all(編集したファイルを全選択)

③ push・・・git push origin develop pullしてからやる

④ pull・・・git hub上のブランチを引き出す

terminal(Mac)編

⓪terminalを消した場合に以下の①～④を試す

①まずは「ls」コマンドで今いるディレクトリの場所を把握、 例)ls

②「ls」コマンドで/Desktopが表示されているようなら「cd」コマンドで/Desktopに移動する。 例)cd Desktop

③②と同じ要領で/git→/brotersに移動する 例) cd git cd broters

④git statusコマンドでいつものmodifyとかnewとか表示されているか確認する。 例) git status ⑤表示されていればOK


■エラー対処
①$git pullできない
(base)xxxxxxxxMacBook-Pro:brothers xxxxxxxx$git pull
error: You have not concluded your merge (MERGE_HEAD exits).
hint: Please, comit your changes before merging.
fatal: Exiting because of unfinished merging.

$git pullはリモートリポジトリ(クラウドにあげてるソースコード)の内容をローカルリポジトリ(自分の作業端末)に反映させるコマンド。
上記のようなエラーが出たら、$git statusで赤色のファイル(addしてないファイル)がないか確認し、あればいったんコミットしてから$git pullすればよい。
