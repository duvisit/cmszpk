<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('HtmlPurifier')
    ->exclude('SlugGenerator')
    ->in(__DIR__ . '/src');

return new Sami($iterator, array(
    'title' => 'Sustav za upravljanje sadržajem',
    'build_dir' => '../doc/api',
    'cache_dir' => '../doc/cache',
    'default_opened_level' => 1
));
