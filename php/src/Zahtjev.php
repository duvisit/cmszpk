<?php
namespace Sustav\Upravljac;

use Sustav\HTTPStatus;

/**
 * HTTP zahtjev.
 *
 * Podržane verzije: HTTP/1.0, HTTP/1.1.
 * Podržane metode: GET, POST, HEAD.
 *
 * ```
 * Primjer:
 * GET /primjer/http/zahtjev?projekt=cmszpk&verzija=1 HTTP/1.0
 * Host: http://example.com
 *
 * https      = false
 * metoda     = GET
 * protokol   = HTTP/1.0
 * domena     = example.com
 * upit       = /primjer/http/zahtjev
 * kategorija = primjer
 * poruka     = [ http, zahtjev ]
 * podaci     = [ projekt => cmszpk, verzija => 1 ]
 * ```
 */
class Zahtjev
{
    /**
     * Vraća adresu web mjesta.
     *
     * ```
     * http://www.example.com
     * ```
     *
     * @return string Adresa.
     */
    public static function httphost() : string
    {
        $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
        return $https ?
            'https://'.$_SERVER['HTTP_HOST'] : 'http://'.$_SERVER['HTTP_HOST'];
    }

    /**
     * Vraća http upit.
     *
     * @return string Upit.
     */
    public static function uri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }
}
