<!-- gallery -->
<?php if ( !empty( $page['media'] )) {
    echo '<div data-uk-scrollspy="{cls:\'uk-animation-fade\'}">',
        '<div class="uk-coverbackground" style="height:600px;',
        'background-image:url(\'', escapeOutput( $page['media'] ), '\');">',
        '</div>',
        '</div>', PHP_EOL;
} ?>
<div class="uk-block-content">
<div class="uk-block uk-block-default">

<section>
<?php echoHtml( $page['content'] ); ?>
</section>

<div class="uk-container uk-container-center">
<section class="uk-grid uk-container-center"
    data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>

<?php foreach( $list as $item ) {
    echo '<div class="uk-width-medium-1-3">',
        '<div class="uk-panel">',
        '<a href="', escapeOutput( $item['media'] ), '"',
        ' data-lightbox-type="image"',
        ' data-uk-lightbox="{group:\'group1\'}"',
        ' title="', escapeOutput( $item['title'] ), '">',
        '<img class="uk-thumbnail uk-thumbnail-medium"',
        ' src="', escapeOutput( $item['media'] ), '"',
        ' alt="', escapeOutput( $item['title'] ), '">',
        '</a>',
        '</div>',
        '</div>', PHP_EOL;
} ?>

</section>
</div>

</div>
</div>

