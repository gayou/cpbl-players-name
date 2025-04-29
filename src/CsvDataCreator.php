<?php namespace Gayou\CpblPlayersName;

use DOMDocument;
use DOMXpath;

use Gayou\CpblPlayersName\CpblPlayersNameConst;

/**
 * CPBLの選手名のcsvデータを生成
 *
 */
class CsvDataCreator
{
    
    private static array $players = [];
    
    public function __construct()
    {
    }
    
    /**
     * 初期化処理
     *
     * @return void
     */
    public static function setup() : void
    {
        // 選手名の一覧を取得
        self::loadPlayers();

        // 選手名の英語表記、日本語表記のcsvファイルを作成
        self::createCsvData();
    }


    /**
     * 繁体字表記の選手一覧から抽出してキャッシュする
     *
     * @return void
     */
    private static function loadPlayers() : void
    {
        $players = [];

        // 繁体字表記の一覧を取得
        $html = file_get_contents(CpblPlayersNameConst::RESOURCE_URL_ZH);

        $document = new DOMDocument();
        @$document->loadHTML($html);

        // 選手ID,選手名を抽出
        $xpath = new DOMXpath($document);
        $result = $xpath->query('//div[@id="Content"]/div[@class="PlayersList"]/dl/dd/a');
        foreach ($result as $anchor) {
            $href = $anchor->getAttribute('href');

            $id = str_replace('/team/person?acnt=', '', $href);
            $name = str_replace(['*', '◎'], '', $anchor->textContent);

            $players[$id]['zh'] = $name;
        }

        // ローマ字表記の一覧を取得
        $html = file_get_contents(CpblPlayersNameConst::RESOURCE_URL_EN);

        $document = new DOMDocument();
        @$document->loadHTML($html);

        // 選手ID,選手名を抽出
        $xpath = new DOMXpath($document);
        $result = $xpath->query('//div[@id="Content"]/div[@class="PlayersList"]/dl/dd/a');
        foreach ($result as $anchor) {
            $href = $anchor->getAttribute('href');

            $id = str_replace('/team/person?acnt=', '', $href);
            $name = $anchor->textContent;

            $players[$id]['en'] = $name;
        }

        self::$players = $players;
    }


    /**
     * 選手名の英語表記、日本語表記の対応表を出力する
     *
     * @return void
     */
    private static function createCsvData() : void
    {
        $data = [];
        $players = self::$players;
        foreach ($players as $id => $player) {
            $data[] = $player['zh'].",".$player['en'];
        }

        // csvファイル出力
        file_put_contents(CpblPlayersNameConst::DATA_FILEPATH, implode("\n", $data));
    }
}
