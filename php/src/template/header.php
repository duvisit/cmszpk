<!DOCTYPE html>
<html lang="<?= \Sustav\Funkcije::escapeOutput( $page['lang'] ) ?>">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( !empty( $page['summary'] )) { ?>
<meta name="description" content="<?= \Sustav\Funkcije::escapeOutput( $page['summary'] ) ?>">
<?php } if ( !empty( $page['keywords'] )) { ?>
<meta name="keywords" content="<?= \Sustav\Funkcije::escapeOutput( $page['keywords'] ) ?>">
<?php } ?>
<title><?= \Sustav\Funkcije::escapeOutput( $page['title'].' | '.$site['logo'] ) ?></title>
<link rel="alternate" hreflang="<?= $lang ?>" href="<?= $vars['url'] . $uri ?>">
<?php foreach ( $langnav as $item ) { ?>
<link rel="alternate" hreflang="<?= $item['lang'] ?>"
href="<?= \Sustav\Funkcije::escapeOutput( $vars['url'].$item['slug'] ) ?>">
<?php } ?>
<link rel="icon" href="/favicon.ico">
<link href="/vendor/minify.css" rel="stylesheet">
<script src="/vendor/minify.js"></script>
</head>
<body>
<!-- header -->
<div class="uk-block uk-padding-bottom-remove uk-contrast uk-hidden-small">
<div class="uk-container uk-container-center">
<div class="uk-grid uk-margin-bottom">
<div class="uk-width-1-2">
<h1 class="uk-heading-large"><?= \Sustav\Funkcije::escapeOutput( $site['logo'] ) ?></h1>
</div>
<div class="uk-width-1-2">
<p class="uk-text-right uk-text-small">
<?= \Sustav\Funkcije::escapeOutput( $site['description'] ) ?><br>
<?= \Sustav\Funkcije::escapeOutput( $site['comment'] ) ?>
</p>
</div>
</div>
</div>
</div>
