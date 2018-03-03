<?php

use Sustav\Pogled\Pogled;
use Sustav\Pogled\Sadrzaj;
use Sustav\Upravljac\Zahtjev;
use Sustav\Upravljac\Upravljac;

date_default_timezone_set('UTC');

if (session_status() != PHP_SESSION_ACTIVE) {
    $logfile = __DIR__.'/error.log';
    error_log(date(DATE_ATOM), 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    error_log("Sesija nije aktivna!", 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    http_response_code(500);
    exit;
}

// PHP Manual:
// Example #1 Use set_error_handler() to change error messages into
// ErrorException.
function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new \ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("exception_error_handler");

try {
require __DIR__.'/autoload.php';
require __DIR__.'/funkcije.php';
    $zahtjev   = new Zahtjev();
    $upravljac = new Upravljac($zahtjev);
    $sadrzaj   = new Sadrzaj($upravljac);
    $pogled    = new Pogled($sadrzaj);
    $pogled->posalji();
} catch (\Exception $e) {
    $logfile = __DIR__.'/error.log';
    error_log(date(DATE_ATOM), 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    error_log($e->getMessage(), 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    error_log(print_r($e->getTrace(), true), 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    http_response_code(500);
}
exit;
