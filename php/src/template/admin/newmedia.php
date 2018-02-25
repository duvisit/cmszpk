<!-- media -->
<?php
include __DIR__.'/snip/formbegin.php';
$page['lang'] = '';
include __DIR__.'/snip/language.php';
$page['display'] = '';
include __DIR__.'/snip/display.php';
$page['media'] = '';
include __DIR__.'/snip/media.php';
$key = 'title';
$input = [ 'name' => $key, ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
$key = 'summary';
$input = [ 'name' => $key, ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
include __DIR__.'/snip/formendnew.php';
