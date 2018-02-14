<?php
namespace UnitTest;

use Sustav\Postavke;
use Sustav\Model\Model;
use PHPUnit\Framework\TestCase;

/**
 * Test Sustav\Model\Model.
 */
class ModelTest extends TestCase
{
    public function testPovezivanjeSBazomPodataka()
    {
        $postavke = new Postavke();
        $this->assertNotNull(Model::dbConnect($postavke->database()));
    }

    public function testDohvatiPodatke()
    {
        $postavke = new Postavke();
        $pdo = Model::dbConnect($postavke->database());
        $res = Model::sqlFetch(
            $pdo,
            'SELECT id,logo FROM website WHERE lang=?',
            ['hr']
        );
        $this->assertEquals(['id'=>'1','logo'=>'Primjer'], $res);
    }
}
