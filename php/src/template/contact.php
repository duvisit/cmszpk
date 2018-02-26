<!-- about -->
<div class="uk-block-content">
<?php include __DIR__.'/snip/googlemap.php'; ?>
<div class="uk-block uk-block-default">
<div class="uk-text-center">
<h1><?= escapeOutput( $site[name] ) ?></h1>
<h2><?= escapeOutput( $site[description] ) ?></h2>
<p>
<?= escapeOutput( $site[address] ) ?><br>
<?= escapeOutput( $site[zipcode] ) ?>, <?= escapeOutput( $site[city] ) ?><br>
<?= escapeOutput( $site[country] ) ?></p>
<?php if ( !empty( $site[phone] )) ?>
<p><span class="uk-icon-phone"></span><?= escapeOutput( $site[phone] ) ?></p>
<?php endif; ?>
</div>
<?php echoHtml( $page['content'] ); ?>
</div>
</div>
