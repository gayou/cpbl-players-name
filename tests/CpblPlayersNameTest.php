<?php namespace Gayou\CpblPlayersName\Test;

use PHPUnit\Framework\TestCase;
use Gayou\CpblPlayersName\CsvDataCreator;
use Gayou\CpblPlayersName\CpblPlayersName;

class CpblPlayersNameTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        CsvDataCreator::setup();
        CpblPlayersName::init();
    }

    /**
     * 選手名のローマ字表記を取得できること
     *
     */
    public function testRomanize()
    {
        // 陳佳樂
        $this->assertSame(CpblPlayersName::romanize('陳佳樂'), 'CHEN Jia Le');

        // 二宮衣沙貴
        $this->assertSame(CpblPlayersName::romanize('二宮衣沙貴'), 'NINOMIYA Isaki');
    }

    /**
     * 選手名の先頭に記号がついていてもローマ字表記を取得できること
     *
     */
    public function testRomanizePrefixSymbol()
    {
        // *陳佳樂
        $this->assertSame(CpblPlayersName::romanize('*陳佳樂'), 'CHEN Jia Le');

        // ◎二宮衣沙貴
        $this->assertSame(CpblPlayersName::romanize('◎二宮衣沙貴'), 'NINOMIYA Isaki');
    }

    /**
     * CPBLに在籍していない選手はnullが返ってくる
     *
     */
    public function testNoRoasterPlayer()
    {
        // 大谷翔平
        $this->assertSame(CpblPlayersName::romanize('大谷翔平'), null);
    }
}
