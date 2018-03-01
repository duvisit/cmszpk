<?php
namespace UnitTest;

use Sustav\Postavke;
use PHPUnit\Framework\TestCase;

/**
 * Test Sustav\Postavke.
 */
class PostavkeTest extends TestCase
{
    public function testPostavkeSuPrisutne()
    {
        $this->assertDirectoryExists(Postavke::htmldir());

        $postavke = new Postavke();
        $this->assertTrue(is_bool($postavke->development()));
        $this->assertTrue(is_bool($postavke->purifyhtml()));
        $this->assertNotEmpty($postavke->database());
        $this->assertNotEmpty($postavke->tables());
        $this->assertNotEmpty($postavke->templates());
        $this->assertNotEmpty($postavke->mediadirs());
        $this->assertNotEmpty($postavke->uploaddir());
        $this->assertNotEmpty($postavke->lang());
        $this->assertNotEmpty($postavke->timezone());

        if ($postavke->development() == true) {
            $this->assertEmpty($postavke->facebookPageId());
            $this->assertEmpty($postavke->facebookAppId());
            $this->assertEmpty($postavke->facebookAppSecret());
            $this->assertEquals(
                'https://www.facebook.com',
                $postavke->facebookUrl()
            );
            $this->assertEmpty($postavke->googleMapToken());
            $this->assertNotEmpty($postavke->googleMapLatLng());
        } else {
            $this->assertEmpty($postavke->facebookPageId());
            $this->assertEmpty($postavke->facebookAppId());
            $this->assertEmpty($postavke->facebookAppSecret());
            $this->assertNotEquals(
                'https://www.facebook.com',
                $postavke->facebookUrl()
            );
            $this->assertNotEmpty($postavke->googleMapToken());
            $this->assertNotEmpty($postavke->googleMapLatLng());
        }
    }
}
