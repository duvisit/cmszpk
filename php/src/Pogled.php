<?php
namespace Sustav\Pogled;

use Sustav\Postavke;
use Sustav\Pogled\Sadrzaj;
use Sustav\Model\Spremnik;
use Sustav\Upravljac\Zahtjev;

/**
 * Pogled na sadržaj.
 */
class Pogled
{
    private $sadrzaj;
    private $htmldir;

    public function __construct(Sadrzaj $sadrzaj)
    {
        $this->sadrzaj = $sadrzaj;
        $this->htmldir = Postavke::htmldir();
    }

    //############################################################################
    // Routing

    public function posalji() {

        $status = $this->sadrzaj->pogledaj();

        switch ( $status['code'] ) {
        case 200:
            if ( isset( $status['cache'] )) {
                $cache = $status['cache'];
                echo $cache->html();
                $restime = sprintf( "%s\tCache completed in %.4f seconds\n",
                    Zahtjev::uri(), microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'], E_USER_NOTICE );
                error_log( $restime, 3, __DIR__.'/cache.log' );
            } else {
                $html = ob_get_clean();
                $cfg = new Postavke();
                $cache = new Spremnik( $status['path'], $cfg->database() );
                $cache->save( $html );
                echo $html;
                $restime = sprintf( "%s\tOutput buffer completed in %.4f seconds\n",
                    $status['path'], microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'], E_USER_NOTICE );
                error_log( $restime, 3, __DIR__.'/cache.log' );
            }
            break;
        case 301:
            $this->redirectPerm( Zahtjev::httphost().$status['path'] );
            break;
        case 302:
            $this->redirectTemp( Zahtjev::httphost().$status['path'] );
            break;
        case 404:
            $this->clientError();
            break;
        case 405:
            $this->methodNotAllowed();
            break;
        case 500:
            $this->serverError();
            break;
        default:
            $this->teapot();
            break;
        }
        return $status['code'];
    }

    //########################################################################
    //HTTP status codes

    // 301 Moved Permanently
    private function redirectPerm ( $location ) {
        header( "Location: $location", true, 301 );
    }

    // 302 Found (Moved Temporarily, HTTP/1.0)
    // 303 See Other (Moved Temporarily, HTTP/1.1)
    private function redirectTemp ( $location ) {
        if ( $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' )
            header( "Location: $location", true, 303 );
        else
            header( "Location: $location", true, 302 );
    }

    // 404 Not Found
    private function clientError () {
        http_response_code( 404 );
        include( $this->htmldir . '404.php' );
    }

    // 405 Method Not Allowed
    private function methodNotAllowed () {
        http_response_code( 405 );
        include( $this->htmldir . '405.php' );
    }

    // 418 I'm a teapot
    private function teapot () {
        http_response_code( 418 );
        echo "I'm a teapot";
    }

    // 500 Internal Server Error
    private function serverError () {
        http_response_code( 500 );
        include( $this->htmldir . '500.php' );
    }
}
