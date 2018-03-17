<!-- staff -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">
<div class="uk-panel uk-panel-box">
<p>
<a class="uk-link" href="/admin/staff/new">Add new</a>
</div>
<?php
use Sustav\Funkcije;
foreach ( $langlist as $group ) {
    echo '<h2>Language: ', Funkcije::esacpeOutput( $group ), '</h2>', PHP_EOL
        , '<div class="uk-grid" data-uk-grid-margin="">', PHP_EOL;
    foreach ( $list as $item ) {
        if ( $item['lang'] === $group )
            echo '<div class="uk-width-medium-1-4">'
            , '<div class="uk-panel uk-panel-box">'
            , '<div class="uk-panel-teaser">'
            , '<img src="', Funkcije::esacpeOutput( $item['media'] ), '">'
            , '</div>'
            , '<p class="uk-text-bold">'
            , Funkcije::esacpeOutput( $item['title'] ), '</h3>'
            , '<p>', Funkcije::esacpeOutput( $item['summary'] ), '</p>'
            , '<p>', purifyHtml( $item['content'] ), '</p>'
            , '<a class="uk-link" href="/admin/staff/'
            , Funkcije::esacpeOutput( $item['id'] ), '">Edit</a>'
            , '</div>'
            , '</div>';
    }
    echo '</div>', PHP_EOL, '<hr class="uk-grid-divider">', PHP_EOL;
} ?>
</div>
</div>
</div>
