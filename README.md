COACHTECH のカリキュラム課題として、
Docker 上で動作する Laravel フリマアプリを構築しました。

本アプリは、会員登録から商品出品・購入・決済までの一連の流れを、
Docker / Docker Compose 環境上で再現可能な形で実装しています。

---

アプリ概要

ユーザー同士で商品を出品・購入できるフリマアプリです。
Docker を用いたローカル開発環境上で動作することを前提とし、
Laravel アプリケーションと MySQL をコンテナとして構成しています。

---

主な機能一覧

認証関連
・会員登録
・ログイン
・ログアウト

商品関連
・商品一覧表示
・商品詳細表示
・商品出品
・商品検索（キーワード検索）
・購入済み商品の「Sold」表示

マイページ
・出品した商品の一覧表示
・購入した商品の一覧表示
・タブ切り替え表示

ユーザー機能
・プロフィール表示
・プロフィール編集（ユーザー名・住所・郵便番号など）
・配送先情報の登録・変更

いいね・コメント
・商品へのいいね登録／解除
・いいね数の表示
・商品へのコメント投稿
・コメント数の表示

購入・決済
・商品購入機能
・Stripe（テスト環境）によるクレジットカード決済
・購入完了画面の表示
・購入後、マイページ購入履歴への反映

---

使用技術

アプリケーション
・PHP 8.4
・Laravel
・Blade
・MySQL
・Stripe（テストモード）
・HTML / CSS / JavaScript

開発環境
・Docker
・Docker Compose
・Git / GitHub

---

Docker 環境構成

本アプリは Docker / Docker Compose を使用して構築しています。

コンテナ構成
app：PHP 8.4 / Laravel アプリ
db：MySQL 8.0

使用ファイル
・Dockerfile
・docker-compose.yml

---

Docker 環境構築手順

1. リポジトリをクローン
   git clone [https://github.com/nonkey826/coachtech-furima.git](https://github.com/nonkey826/coachtech-furima.git)
   cd coachtech-furima

2. Docker コンテナ起動
   docker-compose up -d --build

3. Composer インストール
   docker-compose exec app composer install

4. 環境変数設定
   cp .env.example .env

※ .env には Docker 環境向けの DB 設定、Stripe テストキーを設定しています。

5. アプリケーションキー生成
   docker-compose exec app php artisan key:generate

6. マイグレーション実行
   docker-compose exec app php artisan migrate

---

アプリケーション起動URL

[http://localhost:3000](http://localhost:3000)

docker-compose.yml にて、
Laravel 開発サーバー（php artisan serve）を
0.0.0.0:8000 で起動し、ホストの 3000 ポートに公開しています。

---

データベース設計について

購入済み商品の判定について、
設計書では purchases テーブルを参照する想定でしたが、
Docker 環境での一覧・詳細表示処理を簡潔にするため、

items テーブルに
・is_sold
・buyer_id

を保持する設計としています。

購入履歴管理は purchases テーブルで行っています。

---

テストについて

本アプリは自動テストは実装しておらず、手動で動作確認を行っています。

確認済み項目
・会員登録
・ログイン
・商品一覧／商品詳細表示
・商品出品
・いいね登録／解除
・コメント投稿
・購入フロー
・Stripe テスト決済
・購入履歴・出品履歴反映
・プロフィール編集・住所登録

---

補足
・Stripe 決済はテスト環境（Sandbox）を使用しています
・本アプリは学習目的の模擬案件です

---

ER図
docs/er_drawio.png

---

GitHub リポジトリ
[https://github.com/nonkey826/coachtech-furima](https://github.com/nonkey826/coachtech-furima)

---

作成者
椋棒 望


