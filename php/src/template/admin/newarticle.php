<!-- article/blog -->
<?php
include __DIR__.'/snip/formbegin.php';
$page['lang'] = '';
include __DIR__.'/snip/language.php';
$page['media'] = '';
include __DIR__.'/snip/media.php';
$page['sourceid'] = '';
include __DIR__.'/snip/source.php';
$key = 'title';
$input = [ 'name' => $key, 'label' => ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
$key = 'summary';
$input = [ 'name' => $key, 'label' => ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
$key = 'keywords';
$input = [ 'name' => $key, 'label' => ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
$page['content'] = '';
include __DIR__.'/snip/content.php';
include __DIR__.'/snip/formendnew.php';
