<?php
use Sustav\Postavke;
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

$logfile = __DIR__.'/error.log';
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
ini_set('error_reporting', E_ALL);
ini_set('error_log', $logfile);

try {
    $zahtjev   = new Zahtjev();
    $upravljac = new Upravljac($zahtjev);
    $sadrzaj   = new Sadrzaj($upravljac);
    $pogled    = new Pogled($sadrzaj);
    $pogled->posalji();
} catch (\Exception $e) {
    error_log(date(DATE_ATOM), 3, $logfile);
    error_log("\t", 3, $logfile);
    error_log($e->getMessage(), 3, $logfile);
    error_log(PHP_EOL, 3, $logfile);
    http_response_code(500);
}
exit;
