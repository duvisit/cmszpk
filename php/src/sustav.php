<?php
use Sustav\Pogled\Pogled;
use Sustav\Pogled\Sadrzaj;
use Sustav\Upravljac\Zahtjev;
use Sustav\Upravljac\Upravljac;

require __DIR__.'/autoload.php';

session_start();
set_error_handler(function ($severity, $message, $file, $line) {
    \Sustav\Funkcije::errorHandler($severity, $message, $file, $line);
});
date_default_timezone_set('UTC');

try {
    $zahtjev   = new Zahtjev();
    $upravljac = new Upravljac($zahtjev);
    $sadrzaj   = new Sadrzaj($upravljac);
    $pogled    = new Pogled($sadrzaj);
    $pogled->posalji();
} catch (\Exception $e) {
    $logfile = __DIR__.'/error.log';
    error_log(date(DATE_ATOM), 3, $logfile);
    error_log("\t", 3, $logfile);
    error_log($e->getMessage(), 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    http_response_code(500);
}
exit;
