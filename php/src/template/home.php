<!-- home -->
<?php include __DIR__.'/snip/media.php'; ?>
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<?php
echoHtml( $page['content'] );
include __DIR__.'/snip/fbfeed.php';
include __DIR__.'/snip/featstaff.php';
?>
</div>
<div class="uk-block uk-block-default">
<h1><?= translate( 'Where to find us', $page['lang'] ) ?></h1>
<h2><?= escapeOutput( $site['city'] ) ?>, <?= escapeOutput( $site['country'] ) ?></h2>
</div>
<div class="uk-block-default">
<?php include __DIR__.'/snip/googlemap.php'; ?>
</div>
</div>
