# Yahoo知恵袋風の掲示板サイト

 このプロジェクトは、PHPで作成されたWebアプリケーションです。質問と回答を投稿し、ユーザー間で疑問や回答を投稿できます。

# 機能 
* ユーザー登録とログイン
* 質問の投稿と回答
* ユーザー情報の編集
* passwordの編集
* ユーザーは質問や回答を見ることができる
* ユーザーは質問や回答を投稿することができる
* 質問と回答は誰でも見ることができる
* 質問と回答を投稿するにはログインが必要
* ログインはユーザーが任意で決めたIDとパスワードが必要
* ログインするにはユーザー登録が必要




# 使用している技術
 
* PHP
* Bootstrap
* MySQL

# フォルダ構成
/answers: 回答に関連するファイルが含まれています。  
addanswer.php: 回答を追加するページのコードです。  
delete.php: 回答を削除するページのコードです。  
detail.php: 回答の詳細を表示するページのコードです。  
index.php: 回答一覧を表示するページのコードです。  

/join: ユーザー登録に関連するファイルが含まれています。  
check.php: ユーザー登録時の入力チェックを行うページのコードです。  
index.php: ユーザー登録ページのコードです。  
thanks.php: ユーザー登録完了時のページのコードです。  

/question: 質問に関連するファイルが含まれています。  
addQuestion.php: 質問を追加するページのコードです。  
delete.php: 質問を削除するページのコードです。  
detail.php: 質問の詳細を表示するページのコードです。  
index.php: 質問一覧を表示するページのコードです。  

/users: ユーザー関連のファイルが含まれています。  
change-password.php: パスワード変更ページのコードです。  
edit.php: ユーザー情報編集ページのコードです。  
index.php: ユーザー一覧を表示するページのコードです。  
mypage.php: マイページを表示するコードです。  
update.php: ユーザー情報更新処理を行うページのコードです。  

index.php: ファーストページのコードです。  
dbconnect.php: データベース接続設定が含まれています。  
docker-compose.yml: Docker Composeの設定ファイルです。  
Dockerfile: Dockerイメージの設定ファイルです。  
login.php: ログインページのコードです。  
logout.php: ログアウト処理を行うページのコードです。  
style.css: CSSファイルです。  
apache-config.conf: Apacheの設定ファイルです。  
.htaccess: ApacheのURLリライト設定ファイルです。  

# 環境構築
このwebアプリはdockerを使用します。dockerがインストールされてることを確認してください。

①GitHubからリポジトリをクローンする
git clone  https://github.com/uheiji/php-kadai.git

②Dockerコンテナを起動します
docker-compose up -d

③ブラウザで http://localhost:8000 にアクセスしてアプリケーションを利用できます


# 作成者 

* uheiji
