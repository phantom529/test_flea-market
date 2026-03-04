# test_flea-market

## 概要
模擬案件のフリマアプリです。
## 環境構築
### Dockerビルド
- git clone https://github.com/phantom529/test_flea-market.git
- docker-compose up -d --build
### Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env , 環境変数を適宜変更
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## 開発環境
  - アプリ：http://localhost/
  - ユーザー登録: http://localhost/register  
  - phpMyAdmin：http://http://localhost:8080
  - MailHog：http://localhost:8025

## 使用技術(実行環境)
- PHP 8.2.11
- Laravel 8.83.8
- docker volume
- MySQL 8.0.26
- nginx 1.21.1
- phpMyAdmin
- MailHog

## ER図
```mermaid
erDiagram


