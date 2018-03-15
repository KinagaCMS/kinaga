# kinaga
<img src="https://user-images.githubusercontent.com/25574701/37443256-5780494c-284e-11e8-9ea1-aedb8b40ceb9.png" alt="kinaga" width="300">


___


### 概要

Linux ユーザーに最適化されたCMS

ファイルシステムから管理できる特徴があります

簡単なルールに沿って、フォルダやファイルを配置するだけで、Webサイトが完成します





___


### 動作環境

- PHP 5.5 以上
- Apache 2.2 以上
- .htaccess 及び RewriteEngine が利用可能であること

___



### インストール

- [ダウンロード](https://github.com/KinagaCMS/KinagaCMS/releases)

- パーミッションなどを適宜変更してから公開ディレクトリにアップロードして下さい


___



### 初期設定

1.  /includes/config.php

　　テンプレート、表示言語、文字コードなどを設定することができます

2.  /includes/lang/○○.php

　　サイト名やメールアドレスなどを設定することができます

___


### 簡単な使い方

1.  ファイルマネージャまたは [WinSCP](https://winscp.net/) でサーバーに接続します
2.  「**contents**」フォルダの中に「**カテゴリ名**」のフォルダを作成して下さい
3.  「**カテゴリ名**」フォルダの中に「**記事名**」のフォルダを作成して下さい
4.  「**記事名**」フォルダの中に「**index.html**」ファイルを作成し、[ReText](https://github.com/retext-project/retext)、[Pluma](https://github.com/mate-desktop/pluma)、[Geany](https://github.com/geany/geany/)などのテキストエディタで開き、文章を入力して下さい
5.  また、フォルダやテキストを以下のように配置することで追加機能を利用することも出来ます


		contents
		│
		├── カテゴリ名フォルダ
		│	│
		│	├── 記事名フォルダ
		│	│	│
		│	│	├── comments ( コメント欄が表示されます。必須ではありません )
		│	│	│
		│	│	├── counter.txt ( カウンター。よく読まれている記事が表示されます。必須ではありません )
		│	│	│
		│	│	├── images ( または background-images など。必須ではありません )
		│	│	│
		│	│	└── index.html ( ここに記事を書いて下さい )
		│	│
		│	└── index.html ( カテゴリのサブタイトルです。必須ではありません )
		│
		├── サイドページ.html ( インフォメーションに表示されます。必須ではありません )
		│
		└── index.html ( トップページ。必須ではありません )
___

### ライセンス
-  [GPL v3](https://github.com/KinagaCMS/KinagaCMS/blob/master/LICENSE)
