<!-- staff -->
<div class="uk-block-content">
<?php if ( !empty( $page['media'] )) {
    echo '<div data-uk-scrollspy="{cls:\'uk-animation-fade\'}">',
        '<div class="uk-cover-background" style="height:400px;',
        'background-image:url(\'', escapeOutput( $page['media'] ), '\');">',
        '</div>',
        '</div>', PHP_EOL;
} ?>

<div class="uk-block uk-block-default">

<section>
<?php echoHtml( $page['content'] ); ?>
</section>

<div class="uk-container uk-container-center">
<section>

<?php foreach ( $list as $item ) {
    echo '<div class="uk-block">', PHP_EOL;
    echo '<figure class="uk-overlay">', PHP_EOL;
    echo '<img src="', escapeOutput( $item['media'] ), '">', PHP_EOL;
    echo '<figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom">', PHP_EOL;
    echo '<h3 style="text-align:left;">', escapeOutput( $item['title'] ), '</h3>', PHP_EOL;
    echo '<div class="uk-visible-large">', purifyHtml( $item['content'] ), '</div>', PHP_EOL;
    echo '</figcaption>', PHP_EOL;
    echo '</figure>', PHP_EOL;
    echo '</div>', PHP_EOL;
} ?>

</section>
</div>

</div>
</div>

