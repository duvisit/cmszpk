<!-- home -->
<?php include __DIR__.'/snip/featimage.php'; ?>
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<?php
\Sustav\Funkcije::echoHtml( $page['content'] );
$fbnum = 3;
include __DIR__.'/snip/fbfeed.php';
include __DIR__.'/snip/featstaff.php';
?>
</div>
<div class="uk-block uk-block-default">
<h1><?= \Sustav\Funkcije::escapeTrans( 'Where to find us', $page['lang'] ) ?></h1>
<h2><?= \Sustav\Funkcije::escapeOutput( $site['city'] ) ?>, <?= \Sustav\Funkcije::escapeOutput( $site['country'] ) ?></h2>
</div>
<div class="uk-block-default">
<?php include __DIR__.'/snip/googlemap.php'; ?>
</div>
</div>
