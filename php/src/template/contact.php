<!-- about -->
<div class="uk-block-content">
<?php if ( !empty( $page['media'] )) {
    echo '<div data-uk-scrollspy="{cls:\'uk-animation-fade\'}">',
        '<div class="uk-cover-background" style="height:400px;',
        'background-image:url(\'', escapeOutput( $page['media'] ), '\');">',
        '</div>',
        '</div>', PHP_EOL;
} ?>
<?php if ( empty( $page['media'] )) {
echo '<section>' . PHP_EOL;
include __DIR__.'/googlemap.php';
echo '</section>' . PHP_EOL;
} ?>

<div class="uk-block uk-block-default">

<section>
<div class="uk-text-center">
<?php
    echo '<h1>',
        escapeOutput( $site['name'] ), '</h1>', PHP_EOL,
        '<h2>',
        escapeOutput( $site['description'] ), '</h2>', PHP_EOL,
        '<p>',
        escapeOutput( $site['address'] ), '<br>', PHP_EOL,
        escapeOutput( $site['zipcode'] ), ' ',
        escapeOutput( $site['city'] ), '<br>', PHP_EOL,
        escapeOutput( $site['country'] ), '</p>', PHP_EOL;
    if ( !empty( $site['phone'] ))
        echo '<p><span class="uk-icon-phone"></span> ',
            escapeOutput( $site['phone'] ), '</p>', PHP_EOL;
?>
</div>
</section>

<section>
<?php echoHtml( $page['content'] ); ?>
</section>

</div>
<?php if ( !empty( $page['media'] )) {
echo '<section>' . PHP_EOL;
include __DIR__.'/googlemap.php';
echo '</section>' . PHP_EOL;
} ?>
</div>

