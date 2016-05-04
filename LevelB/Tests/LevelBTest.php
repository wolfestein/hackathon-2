<?php

namespace Hackathon\LevelB\Tests;

use Hackathon\LevelB\Difference;

class LevelBTest extends \PHPUnit_Framework_TestCase
{
    public function testA()
    {
        $miaouss = new Difference('apple', 'aple');

        $this->assertEquals($miaouss->cost, 1);
    }

    public function testB()
    {
        $miaouss = new Difference('coucou', 'poukou');

        $this->assertEquals($miaouss->cost, 2);
    }

    public function testC()
    {
        $miaouss = new Difference('noel', 'leon');

        $this->assertEquals($miaouss->cost, 4);
    }

    public function testD()
    {
        $miaouss = new Difference('flifou', 'aple');

        $this->assertEquals($miaouss->cost, 6);
    }

    public function testE()
    {
        $token1 = date('His');
        $token2 = date('His');
        $miaouss = new Difference('a'.$token1, 'ab'.$token2);

        $this->assertEquals($miaouss->cost, 1);
    }

    public function testF()
    {
        $miaouss = new Difference('poueet', 'pouet');

        $this->assertEquals($miaouss->cost, 1);
    }
}
