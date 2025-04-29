<?php

namespace Gayou\CpblPlayersName;

/**
 * 定数クラス
 *
 */
class CpblPlayersNameConst
{
    public const RESOURCE_URL_ZH = 'https://cpbl.com.tw/player';

    public const RESOURCE_URL_EN = 'https://en.cpbl.com.tw/player';
    
    public const CACHE_DIR = __DIR__.'/../data/';

    public const DATA_FILEPATH= __DIR__.'/../data/player.csv';

    public const EXCLUDE_STRINGS = ['*', '◎'];
}
