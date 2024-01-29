<?php
namespace Sustav;

use Sustav\Upravljac\Zahtjev;

/**
 * Postavke sustava.
 *
 * Postavke su zapisane u datoteci `cmszpk.php`.
 *
 * ```
 * 'lang' => 'hr',
 * 'development' => true,
 * 'cache' => true,
 * 'cachelog' => false,
 * 'database' => array(
 *     'dsn' => 'sqlite:'.__DIR__.'/database/cmszpk.db',
 *     'user' => null,
 *     'pass' => null,
 *     'options' => array(
 *         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 *         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 *         PDO::ATTR_CASE => PDO::CASE_LOWER
 *     ),
 * ),
 * 'facebook_url' => '',
 * 'facebook_page_id' => '',
 * 'facebook_app_id' => '',
 * 'facebook_app_secret' => '',
 * 'facebook_api_version' => '',
 * 'googlemap_token' => '',
 * 'googlemap_latlng' => ''
 * ```
 */
class Postavke
{
    private $postavke = [];
    private $default = array(
        'tables' => array(
            'website', 'page', 'blog', 'article', 'users', 'staff', 'media'
        ),
        'templates' => array(
            'home', 'page', 'blog', 'article', 'staff', 'product', 'gallery',
            'about', 'contact', 'bloglist', 'articlelist', 'stafflist',
            'blogonly', 'articleonly'
        ),
        'mediadirs' => array(
            'media', 'upload'
        )
    );

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->postavke = require __DIR__.'/cmszpk.php';
    }

    /**
     * Direktorij u kojem se nalaze html predlošci.
     *
     * @return string Staza do direktorija.
     */
    public static function htmldir() : string
    {
        return __DIR__.'/template/';
    }

    /**
     * Nazivi tablica u bazi podataka.
     *
     * @return array Polje s nazivima tablica.
     */
    public function tables() : array
    {
        return $this->default['tables'];
    }

    /**
     * Nazivi html predložaka.
     *
     * @return array Polje s nazivima predložaka.
     */
    public function templates() : array
    {
        return $this->default['templates'];
    }

    /**
     * Direktoriji sa slikama.
     *
     * @return array Polje s nazivima direktorija.
     */
    public function mediadirs() : array
    {
        return $this->default['mediadirs'];
    }

    /**
     * Direktorij za učitavanje datoteka.
     *
     * @return string Staza do direktorija.
     */
    public function uploaddir() : string
    {
        return realpath(__DIR__.'/../..');
    }

    /**
     * Naziv domene na kojoj se sustav nalazi.
     *
     * @return string Naziv domene.
     */
    public function url() : string
    {
        return Zahtjev::httphost();
    }

    /**
     * Glavni jezik sustava.
     *
     * @return string Naziv glavnog jezika sustava.
     */
    public function lang() : string
    {
        return $this->postavke['lang'];
    }

    /**
     * Postavke za PHP Database Object (PDO).
     *
     * @return array Postavke baze podataka.
     */
    public function database() : array
    {
        return $this->postavke['database'];
    }

    /**
     * Status razvoja sustava.
     *
     * @return bool Ako je sustav u razvoju TRUE, inače FALSE.
     */
    public function development() : bool
    {
        return $this->postavke['development'];
    }

    /**
     * Sustav koristi spremnik?
     *
     * @return bool Ako se koristi spremnik TRUE, inače FALSE.
     */
    public function cache() : bool
    {
        return $this->postavke['cache'];
    }

    /**
     * Sustav čuva podatke o korištenju spremnika?
     *
     * @return bool Ako se podaci čuvaju TRUE, inače FALSE.
     */
    public function cachelog() : bool
    {
        return $this->postavke['cachelog'];
    }

    /**
     * Vremenska zona za računanje datuma i vremena.
     *
     * @return string Naziv vremenske zone.
     */
    public function timezone() : string
    {
        return 'UTC';
    }

    /**
     * Sustav koristi pročistač html-a?
     *
     * @return bool Ako se koristi pročistač TRUE, inače FALSE.
     */
    public function purifyhtml()
    {
        return true;
    }

    /**
     * Adresa Facebook stranice s kojom je sustav povezan.
     *
     * @return string URL stranice.
     */
    public function facebookUrl() : string
    {
        if (!empty($this->postavke['facebook_url'])) {
            return $this->postavke['facebook_url'];
        }
        return 'https://www.facebook.com';
    }

    /**
     * ID Facebook stranice s kojom je sustav povezan.
     *
     * @return string ID stranice.
     */
    public function facebookPageId() : string
    {
        return $this->postavke['facebook_page_id'];
    }

    /**
     * ID Facebook aplikacije s kojom je sustav povezan.
     *
     * @return string ID aplikacije.
     */
    public function facebookAppId() : string
    {
        return $this->postavke['facebook_app_id'];
    }

    /**
     * Token Facebook aplikacije s kojom je sustav povezan.
     *
     * @return string Tajni token.
     */
    public function facebookAppSecret() : string
    {
        return $this->postavke['facebook_app_secret'];
    }

    /**
     * Verzija programskog sučelja koju Facebook aplikacija koristi.
     *
     * @return string API verzija.
     */
    public function facebookApiVersion() : string
    {
        return $this->postavke['facebook_api_version'];
    }

    /**
     * Token za prikaz Google karte.
     *
     * @return string Token.
     */
    public function googleMapToken() : string
    {
        if (isset($this->postavke['googlemap_token'])) {
            return $this->postavke['googlemap_token'];
        }
        return '';
    }

    /**
     * Geografska širina i dužina mjesta kojeg prikazuje Google karta.
     *
     * @return string Geografska širina i dužina.
     */
    public function googleMapLatLng() : string
    {
        if (!empty($this->postavke['googlemap_latlng'])) {
            return $this->postavke['googlemap_latlng'];
        }
        return '42.644079,18.100319';
    }
}
