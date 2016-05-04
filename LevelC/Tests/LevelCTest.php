<?php

namespace Hackathon\LevelC\Tests;

use Hackathon\LevelC\Steg;

class LevelCTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @light
     */
    public function testA()
    {
        $yo = new Steg();
        $yo->hide(__DIR__.'/test-a.png', __DIR__.'/test-a-dest.png', 'Je suis anonymousse');
        $this->assertEquals(
            md5_file(__DIR__.'/test-a-dest.png'),
            'd1e49107024a1f05a2efb41a24c4fa1a');

        $yoyo = new Steg();
        $yoyo->show(__DIR__.'/test-a-dest.png');
        $this->assertEquals(
            'e27c11b202f92d569ba4118b30f627d3',
            md5($yoyo->clearTxt));
    }

    public function testB()
    {
        $yo = new Steg();
        // Hide Coucou in test-b-dest.png
        $yo->hide(__DIR__.'/test-b.png', __DIR__.'/test-b-dest.png', 'Coucou');

        $this->assertEquals(
            md5_file(__DIR__.'/test-b-dest.png'),
            '28b0ccf90cce8effd0988ac3b8db3d07');

        $yoyo = new Steg();
        $yoyo->show(__DIR__.'/test-b-dest.png');
        $this->assertEquals(
            'coucou',
            $yoyo->clearTxt);
    }

    public function testC()
    {
        $yo = new Steg();
        $yo->hide(__DIR__.'/test-c.png', __DIR__.'/test-c-dest.png', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?');

        $this->assertEquals(
            md5_file(__DIR__.'/test-c-dest.png'),
            '0c617583da284d3364411e37784f7c7d');

        $yoyo = new Steg();
        $yoyo->show(__DIR__.'/test-c-dest.png');
        $this->assertEquals(
            'sed-ut-perspiciatis-unde-omnis-iste-natus-error-sit-voluptatem-accusantium-doloremque-laudantium-totam-rem-aperiam-eaque-ipsa-quae-ab-illo-inventore-veritatis-et-quasi-architecto-beatae-vitae-dicta-sunt-explicabo-nemo-enim-ipsam-voluptatem-quia-voluptas-sit-aspernatur-aut-odit-aut-fugit-sed-quia-consequuntur-magni-dolores-eos-qui-ratione-voluptatem-sequi-nesciunt-neque-porro-quisquam-est-qui-dolorem-ipsum-quia-do',
            $yoyo->clearTxt);
    }
}
