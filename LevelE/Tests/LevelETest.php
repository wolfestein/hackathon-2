<?php

namespace Hackathon\LevelE\Tests;

use Hackathon\LevelE\Compress;

class LevelETest extends \PHPUnit_Framework_TestCase
{
    public function testA()
    {
        $a = new Compress(__DIR__.'/test-a1.png');
        $b = new Compress(__DIR__.'/test-a2.png');

        $this->assertEquals(
            $a->getFingerprint(),
            'dicediloraba');

        $this->assertEquals(
            $b->getFingerprint(),
            'cedilodiraba');

        $this->assertEquals(
            $a->compareFingerprint($b->getFingerprint()),
            '4');

        $this->assertEquals(
            levenshtein(
                soundex($a->getFingerprint()),
                soundex($b->getFingerprint())),
            '3');
    }

    public function testB()
    {
        $a = new Compress(__DIR__.'/test-b1.png');
        $b = new Compress(__DIR__.'/test-b2.png');
        $c = new Compress(__DIR__.'/test-b3.png');

        $this->assertEquals(
            $a->getFingerprint(),
            'babahahahaje');

        $this->assertEquals(
            $b->getFingerprint(),
            'babahahahaje');

        $this->assertEquals(
            $c->getFingerprint(),
            'babahahahaje');

        $this->assertEquals(
            $a->compareFingerprint($b->getFingerprint()),
            '0');

        $this->assertEquals(
            $a->compareFingerprint($c->getFingerprint()),
            '0');
    }

    public function testC()
    {
        $a = new Compress(__DIR__.'/test-c1.png');
        $b = new Compress(__DIR__.'/test-c2.png');
        $c = new Compress(__DIR__.'/test-c3.png');
        $d = new Compress(__DIR__.'/test-c4.png');

        $this->assertEquals(
            $a->getFingerprint(),
            'cecehahahaba');

        $this->assertEquals(
            $b->getFingerprint(),
            'cecehaharaba');

        $this->assertEquals(
            $c->getFingerprint(),
            'cecehahakiba');

        $this->assertEquals(
            $d->getFingerprint(),
            'cecehahavoba');

        $this->assertEquals(
            $a->compareFingerprint($b->getFingerprint()),
            '1');

        $this->assertEquals(
            $c->compareFingerprint($d->getFingerprint()),
            '2');

        $this->assertEquals(
            $d->compareFingerprint($d->getFingerprint()),
            '0');

        $this->assertEquals(
            $b->compareFingerprint($d->getFingerprint()),
            '2');
    }
}
