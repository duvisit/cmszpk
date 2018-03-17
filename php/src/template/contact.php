<!-- about -->
<div class="uk-block-content">
<?php include __DIR__.'/snip/googlemap.php'; ?>
<div class="uk-block uk-block-default">
<div class="uk-text-center">
<h1><?= \Sustav\Funkcije::escapeOutput( $site[name] ) ?></h1>
<h2><?= \Sustav\Funkcije::escapeOutput( $site[description] ) ?></h2>
<p>
<?= \Sustav\Funkcije::escapeOutput( $site[address] ) ?><br>
<?= \Sustav\Funkcije::escapeOutput( $site[zipcode] ) ?>,
<?= \Sustav\Funkcije::escapeOutput( $site[city] ) ?><br>
<?= \Sustav\Funkcije::escapeOutput( $site[country] ) ?></p>
<?php if ( !empty( $site[phone] )) { ?>
<p><span class="uk-icon-phone"></span>
<?= \Sustav\Funkcije::escapeOutput( $site[phone] ) ?></p>
<?php } ?>
</div>
<?= \Sustav\Funkcije::escapeHtml( $page['content'] ) ?>
</div>
</div>
