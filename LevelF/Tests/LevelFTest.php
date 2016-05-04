<?php

namespace Hackathon\LevelF\Tests;

use Hackathon\LevelF\Debug;

class LevelFTest extends \PHPUnit_Framework_TestCase
{
    public function testA()
    {
        $token = date('His');
        $test = new Debug($token);

        $this->assertEquals(
            $test->myList()['return'],
            2);

        $this->assertEquals(
            $test->myList()['cheat'],
            $token);
    }

    public function testB()
    {
        $token = date('His');
        $test = new Debug($token);

        $this->assertEquals(
            $test->myArraysAreEquals()['return'],
            true);

        $this->assertEquals(
            $test->myList()['cheat'],
            $token);
    }

    // Nothing to debug here (Just For Fun)
    public function testC()
    {
        $test = new Debug('');
        $this->assertEquals(
            $test->trueEqualsFalse(),
            true);
    }

    public function testD()
    {
        $token = date('His');
        $test = new Debug($token);

        $this->assertEquals(
            $test->increment('a'),
            'b');

        $this->assertEquals(
            $test->increment('aa'),
            'ab');

        $this->assertEquals(
            $test->increment($token),
            $token + 1);

        $this->assertEquals(
            $test->increment(666),
            667);

        $this->assertEquals(
            $test->increment('1e2'),
            '1e3');
    }
}
