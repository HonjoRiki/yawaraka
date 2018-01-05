# yawaraka
「やわらか掲示板」のソースコードです。

## join.php
アカウントを新規登録するためのコードです。入力した内容をデータベースに保存します。

## login.php
データベースに保存されているユーザー名とパスワード、それと入力したユーザー名とパスワードが一致していれば、
ユーザー名をセッションに格納して掲示板メイン画面へ移動します。

## board.php
データベースに登録されているコメント、コメント主の名前、登録した時間を表示していきます。
「コメントする」を押すとpost.phpが起動します。

## post.php
コメント欄に入力した文字、ユーザー名、入力した時間をデータベースに格納します。
その後、board.phpに戻ります。

## logout.php
セッション内容をリセットしてindex.htmlに戻ります。
