<!-- page -->
<?php
include __DIR__.'/snip/formbegin.php';
include __DIR__.'/snip/language.php';
$key = 'menuid';
$input = [ 'name' => $key, 'label' => 'Menu ID', 'value' => $page[$key] ];
include __DIR__.'/snip/inputtext.php';
include __DIR__.'/snip/template.php';
include __DIR__.'/snip/featimage.php';
include __DIR__.'/snip/source.php';
$key = 'title';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => $page[$key] ];
include __DIR__.'/snip/inputtext.php';
$key = 'summary';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => $page[$key] ];
include __DIR__.'/snip/inputtext.php';
$key = 'keywords';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => $page[$key] ];
include __DIR__.'/snip/inputtext.php';
include __DIR__.'/snip/content.php';
include __DIR__.'/snip/formendedit.php';
