<?php
namespace UnitTest;

use Sustav\Upravljac\Zahtjev;
use PHPUnit\Framework\TestCase;

/**
 * Test Sustav\Upravljac\Zahtjev.
 */
class ZahtjevTest extends TestCase
{
    public function testAdresaWebMjesta()
    {
        $_SERVER['HTTP_HOST'] = 'example.com';

        unset($_SERVER['HTTPS']);
        $this->assertEquals('http://example.com', Zahtjev::httphost());

        $_SERVER['HTTPS'] = 'off';
        $this->assertEquals('http://example.com', Zahtjev::httphost());

        $_SERVER['HTTPS'] = 'on';
        $this->assertEquals('https://example.com', Zahtjev::httphost());
    }

    public function testUpitZahtjeva()
    {
        $_SERVER['REQUEST_URI'] = '/test/uri';
        $this->assertEquals('/test/uri', Zahtjev::uri());
    }
}
