<?php
namespace UnitTest;

use Sustav\Postavke;
use Sustav\Model\Model;
use Sustav\Upravljac\Sesija;
use PHPUnit\Framework\TestCase;

/**
 * Test Sustav\Upravljac\Sesija.
 */
class SesijaTest extends TestCase
{
    public function testGetUser()
    {
        $postavke = new Postavke();
        extract(
            Sesija::getUser($postavke->database(), 'cmszpk'),
            EXTR_OVERWRITE
        );
        $this->assertEquals('cmszpk', $username);
        $this->assertTrue(password_verify('3457689', $password));
    }

    public function testIsAdmin()
    {
        $_SESSION['username'] = 'cmszpk';
        $postavke = new Postavke();
        $this->assertTrue(Sesija::isAdmin($postavke->database()));
    }
}
