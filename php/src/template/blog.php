<!-- blog -->
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

</div>
</div>

