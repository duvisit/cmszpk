<!-- staff -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">
<div class="uk-panel uk-panel-box">
<p>
<a class="uk-link" href="/admin/staff/new">Add new</a>
</div>
<?php foreach ( $langlist as $group ) {
    echo '<h2>Language: ' . escapeOutput( $group ) . '</h2>' . "\n"
        . '<div class="uk-grid" data-uk-grid-margin="">' . "\n";
    foreach ( $list as $item ) {
        if ( $item['lang'] === $group )
            echo '<div class="uk-width-medium-1-4">'
            . '<div class="uk-panel uk-panel-box">'
            . '<div class="uk-panel-teaser">'
            . '<img src="' . escapeOutput( $item['media'] ) . '">'
            . '</div>'
            . '<p class="uk-text-bold">'
            . escapeOutput( $item['title'] ) . '</h3>'
            . '<p>' . escapeOutput( $item['summary'] ) . '</p>'
            . '<p>' . purifyHtml( $item['content'] ) . '</p>'
            . '<a class="uk-link" href="/admin/staff/'
            . escapeOutput( $item['id'] ) . '">Edit</a>'
            . '</div>'
            . '</div>';
    }
    echo '</div>' . "\n"
        . '<hr class="uk-grid-divider">' . "\n";
} ?>
</div>
</div>
</div>

