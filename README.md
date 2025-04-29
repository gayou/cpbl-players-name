# cpbl-players-name
CPBLの選手名をローマ字表記にするライブラリ。

繁体字表記・ローマ字表記の対応表はCPBLの選手一覧ページをクロールして生成する。

繁体字表記
https://cpbl.com.tw/player

ローマ字表記
https://en.cpbl.com.tw/player

リンク先の選手IDのパラメータが一致するもの同士を繁体字とローマ字のセットとしている。


## 使い方
### インストール、初期設定
```
# install
git clone git@github.com:gayou/cpbl-players-name.git

# setup
cd cpbl-players-name

# 選手名の繁体字表記、ローマ字表記のcsvファイルを生成
composer setup-cpbl-players-name
```

### サンプルコード
```php
<?php
require_once "vendor/autoload.php";

use Gayou\CpblPlayersName\CpblPlayersName;

CpblPlayersName::init();
echo CpblPlayersName::romanize('陳佳樂').PHP_EOL;
echo CpblPlayersName::romanize('二宮衣沙貴').PHP_EOL;
```

### 実行結果
```
CHEN Jia Le
NINOMIYA Isaki
```
