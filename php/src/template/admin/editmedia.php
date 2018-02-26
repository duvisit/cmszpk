<!-- media -->
<?php
include __DIR__.'/snip/formbegin.php';
include __DIR__.'/snip/language.php';
include __DIR__.'/snip/display.php';
include __DIR__.'/snip/media.php';
$key = 'title';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => $page[$key] ];
include __DIR__.'/snip/inputtext.php';
$key = 'summary';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => $page[$key] ];
include __DIR__.'/snip/inputtext.php';
include __DIR__.'/snip/formendedit.php';
