<?php

namespace Hackathon\LevelD\Tests;

use Hackathon\LevelD\Brute;

class LevelDTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @medium
     */
    public function testA()
    {
        $brutus = new Brute('585adf88cdd3693831b0748f409ce846');
        $brutus->force();

        $this->assertEquals(
            md5($brutus->origin),
            '585adf88cdd3693831b0748f409ce846');
    }

    public function testB()
    {
        $brutus = new Brute('281847025');
        $brutus->force();
        $this->assertEquals(
            md5($brutus->origin),
            'f71dbe52628a3f83a77ab494817525c6');
    }

    public function testC()
    {
        $brutus = new Brute('81fe8bfe87576c3ecb22426f8e57847382917acf');
        $brutus->force();
        $this->assertEquals(
            md5($brutus->origin),
            'e2fc714c4727ee9395f324cd2e7f331f');
    }

    public function testD()
    {
        $brutus = new Brute('Zmlmbw==');
        $brutus->force();
        $this->assertEquals(
            md5($brutus->origin),
            'cf54937a2330ac17aa523bf7130911a3');
    }
}
