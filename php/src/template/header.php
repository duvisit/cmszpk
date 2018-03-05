<!DOCTYPE html>
<html lang="<?php echoOutput( $page['lang'] ); ?>">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
if ( !empty( $page['summary'] )) {
echo '<meta name="description" content="', echoOutput( $page['summary'] ), '">', PHP_EOL;
}
if ( !empty( $page['keywords'] )) {
echo '<meta name="keywords" content="', echoOutput( $page['keywords'] ), '">', PHP_EOL;
} ?>
<title><?php echoOutput( $page['title'].' | '.$site['logo'] ); ?></title>
<link rel="alternate" hreflang="<?= $lang ?>" href="<?= $vars['url'] . $uri ?>">
<?php foreach ( $langnav as $item ) { ?>
<link rel="alternate" hreflang="<?= $item['lang'] ?>" href="<?= escapeOutput( $vars['url'].$item['slug'] ) ?>">
<?php } ?>
<link rel="icon" href="/favicon.ico">
<!--
<link href="/vendor/uikit/dist/css/uikit.css" rel="stylesheet">
<link href="/vendor/uikit/dist/css/components/sticky.css" rel="stylesheet">
<link href="/vendor/uikit/dist/css/components/slidenav.css" rel="stylesheet">
<script src="/vendor/js/jquery.js"></script>
<script src="/vendor/uikit/dist/js/uikit.min.js"></script>
<script src="/vendor/uikit/dist/js/components/sticky.js"></script>
<script src="/vendor/uikit/dist/js/components/lightbox.js"></script>
-->
<link href="/vendor/minify.css" rel="stylesheet">
<script src="/vendor/minify.js"></script>
</head>
<body>
<!-- header -->
<div class="uk-block uk-padding-bottom-remove uk-contrast uk-hidden-small">
<div class="uk-container uk-container-center">
<div class="uk-grid uk-margin-bottom">
<div class="uk-width-1-2">
<h1 class="uk-heading-large"><?php echoOutput( $site['logo'] ); ?></h1>
</div>
<div class="uk-width-1-2">
<p class="uk-text-right uk-text-small">
<?php echoOutput( $site['description'] ); ?><br>
<?php echoOutput( $site['comment'] ); ?>
</p>
</div>
</div>
</div>
</div>
