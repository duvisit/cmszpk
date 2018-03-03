<?php
/** Minify JavaScript and CSS.  */
use MatthiasMullie\Minify;

require realpath( __DIR__.'/../src/autoload.php' );

$vendordir = realpath( __DIR__.'/../../vendor/' );

$javascript = [
    $vendordir.'/js/jquery.js',
    $vendordir.'/uikit/dist/js/uikit.min.js',
    $vendordir.'/uikit/dist/js/components/sticky.js',
    $vendordir.'/uikit/dist/js/components/slideshow.js',
    $vendordir.'/uikit/dist/js/components/lightbox.js'
];
$minifier = new Minify\JS();
foreach ($javascript as $js) {
    $minifier->add( $js );
}
// save minified file to disk
$minifier->minify( $vendordir.'/minify.js' );

$stylesheet = [
    $vendordir.'/uikit/dist/css/uikit.css',
    $vendordir.'/uikit/dist/css/components/sticky.css',
    $vendordir.'/uikit/dist/css/components/slideshow.css'
];
$minifier = new Minify\CSS();
foreach ($stylesheet as $css) {
    $minifier->add( $css );
}
// save minified file to disk
$minifier->minify( $vendordir.'/minify.css' );

