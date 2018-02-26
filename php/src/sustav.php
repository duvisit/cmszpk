<?php

use Sustav\Pogled\Pogled;
use Sustav\Pogled\Sadrzaj;
use Sustav\Upravljac\Zahtjev;
use Sustav\Upravljac\Upravljac;

date_default_timezone_set('UTC');

if (session_status() != PHP_SESSION_ACTIVE) {
    error_log(date(DATE_ATOM), 3, __DIR__.'/error.log');
    error_log(PHP_EOL, 3, __DIR__.'/error.log');
    error_log("Sesija nije aktivna!", 3, __DIR__.'/error.log');
    error_log(PHP_EOL, 3, __DIR__.'/error.log');
    http_response_code(500);
    exit;
}

try {
require __DIR__.'/autoload.php';
require __DIR__.'/funkcije.php';
    $zahtjev   = new Zahtjev();
    $upravljac = new Upravljac($zahtjev);
    $sadrzaj   = new Sadrzaj($upravljac);
    $pogled    = new Pogled($sadrzaj);
    $pogled->posalji();
} catch (\Exception $e) {
    error_log(date(DATE_ATOM), 3, __DIR__.'/error.log');
    error_log(PHP_EOL, 3, __DIR__.'/error.log');
    error_log($e->getMessage(), 3, __DIR__.'/error.log');
    error_log(PHP_EOL, 3, __DIR__.'/error.log');
    http_response_code(500);
}
exit;
