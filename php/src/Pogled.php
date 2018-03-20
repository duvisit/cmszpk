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
    private $cache;
    private $cachelog;
    private $database;

    /**
     * Konstruktor.
     *
     * @param Sadrzaj $sadrzaj Sadržaj.
     */
    public function __construct(Sadrzaj $sadrzaj)
    {
        $this->sadrzaj = $sadrzaj;
        $this->htmldir = Postavke::htmldir();

        $postavke = new Postavke();
        $this->cache = $postavke->cache();
        $this->cachelog = $postavke->cachelog();
        $this->database = $postavke->database();
    }

    /**
     * Pošalji sadržaj html pregledniku.
     */
    public function posalji()
    {
        $status = $this->sadrzaj->pogledaj();

        switch ($status['code']) {
            case 200:
                $type = 'normal';
                if ($this->cache) {
                    if (isset($status['cache'])) {
                        $type = 'cache';
                        $cache = $status['cache'];
                        echo $cache->html();
                    } else {
                        $type = 'buffer';
                        $html = ob_get_clean();
                        if (isset($status['path'])) {
                            $cache = new Spremnik($status['path'], $this->database);
                            $cache->save($html);
                        }
                        echo $html;
                    }
                }
                if ($this->cachelog) {
                    $str = sprintf(
                        "%s\t%s\t%.4f\n",
                        Zahtjev::uri(),
                        $type,
                        microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']
                    );
                    error_log($str, 3, __DIR__.'/cache.log');
                }
                break;
            case 301:
                $this->redirectPerm(Zahtjev::httphost().$status['path']);
                break;
            case 302:
                $this->redirectTemp(Zahtjev::httphost().$status['path']);
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
    }

    // 301 Moved Permanently
    private function redirectPerm(string $location) : void
    {
        header("Location: $location", true, 301);
    }

    // 302 Found (Moved Temporarily, HTTP/1.0)
    // 303 See Other (Moved Temporarily, HTTP/1.1)
    private function redirectTemp(string $location) : void
    {
        if ($_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
            header("Location: $location", true, 303);
        } else {
            header("Location: $location", true, 302);
        }
    }

    // 404 Not Found
    private function clientError() : void
    {
        http_response_code(404);
        include($this->htmldir . '404.php');
    }

    // 405 Method Not Allowed
    private function methodNotAllowed() : void
    {
        http_response_code(405);
        include($this->htmldir . '405.php');
    }

    // 418 I'm a teapot
    private function teapot() : void
    {
        http_response_code(418);
        echo "I'm a teapot";
    }

    // 500 Internal Server Error
    private function serverError() : void
    {
        http_response_code(500);
        include($this->htmldir . '500.php');
    }
}
