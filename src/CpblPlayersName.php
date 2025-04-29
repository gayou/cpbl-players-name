<?php namespace Gayou\CpblPlayersName;

use Gayou\CpblPlayersName\CpblPlayersNameConst;

/**
 * MLB選手の名前を日本語表記にする
 *
 */
class CpblPlayersName
{
    
    private static $map = [];
        
    /**
     * 初期化処理
     *
     */
    public static function init() : void
    {
        // 選手名のmapを作成
        self::$map = self::loadCsvData();
    }


    /**
     * csvファイルを読み込んで選手名の繁体字表記、ローマ字表記の連想配列を生成
     *
     * @return array 選手名の繁体字表記、ローマ字表記連想配列
     */
    private static function loadCsvData() : array
    {
        $map = [];

        // csvファイルをロードして選手名の連想配列を生成
        $fp = fopen(CpblPlayersNameConst::DATA_FILEPATH, 'r');

        while ($line = fgetcsv($fp)) {
            $map[$line[0]] = $line[1];
        }

        fclose($fp);

        return $map;
    }


    /**
     * 選手名をローマ字表記で返す
     *
     * @param string $name 選手名（繁体字表記）
     * @return string|null 選手名（ローマ字表記）、選手名が見つからなかった場合はnull
     */
    public static function romanize(string $name) : string|null
    {
        return self::search($name);
    }


    private static function search(string $name) : string|null
    {
        if (array_key_exists($name, self::$map)) {
            return self::$map[$name];
        }

        return null;
    }
}
