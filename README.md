<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# 概要
https://note.com/ に関して投稿した記事の整理を可能にするアプリ

ユーザーはログイン後記事の題名、目次、タグから投稿を確認、記事に飛ぶことができる他  
ユーザー自身のプロフィールも確認できる。

# インストール
laravel・データベースの環境(mysql)は持っていることが前提

git clone https://github.com/SakaiTaka23/OrganizeNote.git  
cd oraganizenote
composer install  
php artisan key:generate  
データベースを作成  
cp .env.example .env  
.envファイルのデータベース、ユーザーネーム、パスワードの修正  
php artisan migrate:fresh  
php artisan serve  

# ログインurl

{domain}/login

# 注意点
## 新規登録

・noteurlとはnote公式でnoteidと呼ばれているものを指している