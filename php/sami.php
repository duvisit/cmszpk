<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('htmlpurifier')
    ->exclude('sluggenerator')
    ->in(__DIR__ . '/src');

return new Sami($iterator, array(
    'title' => 'Sustav za upravljanje sadržajem',
    'build_dir' => '../docs/api',
    'cache_dir' => '../docs/cache',
    'default_opened_level' => 1
));
