<!-- bloglist -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<section>
<h1>Blog</h1>
<?php
foreach ( $list as $item ) {
    echo '<article class="uk-article">'
        . '<h2 class="uk-article-title">'
        . '<a class="uk-link" href="' . $listhref . $item['slug']
        . '">' . $item['title'] . '</a>'
        . '</h2>'
        . '<p class="uk-article-meta">' . $item['datum'] . '</p>'
        . '<p class="uk-article-lead">' . $item['summary'] . '</p>'
        . '</article>' . "\n"
        . '<hr class="uk-article-divider">' . PHP_EOL;
} ?>
</section>

</div>
</div>
</div>

