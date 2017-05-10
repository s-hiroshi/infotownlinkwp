# InfoTownLinkWp 製品マニュアル

WordPressの投稿内容をEC-CUBE3の商品登録ページへ表示するプラグインです。

## 機能

プラグインをインストールするとコンテンツ管理へ「LinkWp 投稿表示タグ」メニューが追加されます。  
「LinkWp 投稿表示タグ」画面でWordPressの投稿を表示するためのタグを発行します。  
発行したタグを商品登録画面のフリーエリアへ貼付けることでWordPressの投稿を表示します。 

## プラグイン設定

2つの項目を設定してください。

* WordPress サイトアドレス(URL)
* WP APIパス(デフォルト wp-json)  
  ほとんどの場合、デフォルトのwp-jsonを変更する必要はありません。

## 要件

* WordPress 4.7.4以上
* PHP 5.4以上  
  PHP 5.4で導入された機能を利用しています。
* MySQL  
  EC-CUBE3のインストール要件に準じます。

## 追加テーブル

plg_infotown_linkwp_wordpress  
WordPressの基本設定情報を管理します。

## マークアップ

表示のマークアップは下記のようになります。

### 内容(contents)

	<div class="linkwp">
		<div class="linkwp-contents">
			<div>タイトル1</div>
			<div>
				コンテンツ1です。
			</div>
		</div><!-- .linkwp-contents -->
		.....
		
		<div class="linkwp-contents">
			<div>タイトルN</div>
			<div>
				コンテンツNです。
			</div>
		</div><!-- .linkwp-contents -->
	</div>

### リンク(links)

	<div class="linkwp">
	  <span class="linkwp-links">
		  <a href="http://www.example.com/?p=1">サンプル記事1</a>
	  </span>
	  .....
	  <span class="linkwp-links">
		  <a href="http://www.example.com/?p=n">サンプル記事N</a>
	  </span>
	</div>

## アンインストール時の注意

アンインストールでは商品登録画面のフリーエリアに記載したタグを自動で削除することはありません。  
(タグはHTMLのコメント形式ですのでアンインストール後は単にHTMLのコメントとして扱われます。)


## 変更履歴

## version 2.0.0

* WordPress 4.7.4へ対応しました。
* WordPressのコア機能で利用できる内容へ変更しました。

## version 1.0.1

* フリーエリアの投稿取得タグ複数入力へ対応しました。
* 投稿表示タグ画面でWordPressから取得した内容の編集機能を追加しました。
* 投稿表示タグ画面のモバイル端末での見た目を改善しました。
* 設定画面でユーザーメッセージを改善しました。


# InfoTownLinkWp 開発マニュアル

## ローカル環境

* テスト実行
* ドキュメンテーション作成
* ビルド  
  bin/buildディレクトリに申請用ファイルinfotownlinkwp.tar.gzを作成します。

### 開発環境構築

タスクランナーは[Grunt](https://gruntjs.com/)を使用します。  
テストは[PHPUnit](https://phpunit.de/)を使用します。  
ドキュメンテーションは[phpDocumentor](https://www.phpdoc.org/)を使用します。

	$ /path/to/bin
	$ grunt install

	//テスト実行
	$ grunt tests
	// ドキュメンテーション作成
	$ grunt docs
	// ビルド bin/buildディレクトリへintowonlinkwp.tar.gz作成
	$ grunt build

## サーバー環境(Travis CI)

Travis CIで各種環境のテストを行います。  
詳細は公式の開発ドキュメントに記載されています。

[CIを利用したプラグインのテスト | EC-CUBE 開発ドキュメント](http://doc.ec-cube.net/plugin_test)

