<!-- home -->
<?php if ( !empty( $page['media'] )) {
    echo '<div data-uk-scrollspy="{cls:\'uk-animation-fade\'}">', PHP_EOL,
        '<div class="uk-cover-background"', PHP_EOL,
        'style="height:600px; background-image:url(\'',
        escapeOutput( $page['media'] ), '\');">', PHP_EOL,
        '</div>', PHP_EOL,
        '</div>', PHP_EOL, PHP_EOL;
} ?>
<div class="uk-block-content">
<div class="uk-block uk-block-default">

<section>
<?php echoHtml( $page['content'] ); ?>
</section>

<?php include __DIR__.'/fbfeed.php'; ?>

<?php if ( $featstaff !== false && !empty( $featstaff )) {
    echo '<div data-uk-scrollspy="{cls:\'uk-animation-fade\'}">', PHP_EOL,
        '<div class="uk-cover-background"', PHP_EOL,
        'style="height:400px; background-image:url(\'',
        escapeOutput( $featstaff ), '\');">', PHP_EOL,
        '</div>', PHP_EOL,
        '</div>', PHP_EOL, PHP_EOL;
} ?>

</div>

<div class="uk-block uk-block-default">
<?php if ( $page['lang'] === 'hr' ) {
    echo '<h1>Gdje se nalazimo</h1>', PHP_EOL;
} else {
    echo '<h1>Where to find us</h1>', PHP_EOL;
} ?>
<h2><?= $site['city'] ?>, <?= $site['country'] ?></h2>
</div>

<div class="uk-block-default">
<?php include __DIR__.'/googlemap.php'; ?>

</div>
</div>
