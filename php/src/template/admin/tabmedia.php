<!-- media -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">
<div class="uk-grid">
<div class="uk-width-small-1-3">
<a class="uk-button uk-width-1-1" href="/admin/media/new">Add new</a>
</div>
<div class="uk-width-small-1-3">
<a class="uk-button uk-width-1-1" href="/admin/upload">Upload</a>
</div>
<div class="uk-width-small-1-3">
<a class="uk-button uk-width-1-1" href="/admin/cleanup">Delete unused</a>
</div>
</div>
<?php
use Sustav\Funkcije;
foreach ( $typelist as $typegroup ) {
    echo '<h2>Display type: ', Funkcije::escapeOutput( $typegroup ), '</h2>', PHP_EOL;
    foreach ( $langlist as $langgroup ) {
        echo '<h3>Language: ', Funkcije::escapeOutput( $langgroup ), '</h3>', PHP_EOL
            , '<div class="uk-grid" data-uk-grid-margin="">', PHP_EOL;
        foreach ( $list as $item ) {
            if ( $item['display'] === $typegroup && $item['lang'] === $langgroup )
                echo '<div class="uk-width-medium-1-4">'
                , '<div class="uk-panel uk-panel-box">'
                , '<div class="uk-panel-teaser">'
                , '<img src="', Funkcije::escapeOutput( $item['media'] ), '">'
                , '</div>'
                , '<p class="uk-text-bold">'
                , Funkcije::escapeOutput( $item['title'] ), '</h3>'
                , '<p>', Funkcije::escapeOutput( $item['media'] ), '</p>'
                , '<p>', Funkcije::escapeOutput( $item['summary'] ), '</p>'
                , '<a class="uk-link" href="/admin/media/'
                , Funkcije::escapeOutput( $item['id'] ), '">Edit</a>'
                , '</div>'
                , '</div>';
        }
        echo '</div>', PHP_EOL, '<hr class="uk-grid-divider">', PHP_EOL;
    }
} ?>
</div>
</div>
</div>
