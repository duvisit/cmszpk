<!-- users -->
<?php
include __DIR__.'/snip/formbegin.php';
$key = 'username';
$input = [ 'name' => $key, 'label' => ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
include __DIR__.'/snip/password.php';
$key = 'email';
$input = [ 'name' => $key, 'label' => ucfirst($key), 'value' => '' ];
include __DIR__.'/snip/inputtext.php';
include __DIR__.'/snip/formendnew.php';
