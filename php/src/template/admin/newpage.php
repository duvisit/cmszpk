<!-- page -->
<?php
include __DIR__.'/snip/formbegin.php';
$page['lang'] = '';
include __DIR__.'/snip/language.php';
$key = 'menuid';
$input = [ 'name' => $key, 'label' => 'Menu ID', 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
$page['template'] = '';
include __DIR__.'/snip/template.php';
$page['media'] = '';
include __DIR__.'/snip/featimage.php';
$page['sourceid'] = '';
include __DIR__.'/snip/source.php';
$key = 'title';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
$key = 'summary';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => '' ];
include __DIR__.'/snip/inputtextnotreq.php';
$key = 'keywords';
$input = [ 'name' => $key, 'label' => ucwords($key), 'value' => '' ];
include __DIR__.'/snip/inputtextnotreq.php';
$page['content'] = '';
include __DIR__.'/snip/content.php';
include __DIR__.'/snip/formendnew.php';
