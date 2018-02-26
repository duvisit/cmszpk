<!-- list -->
<?php foreach ( $list as $item ) { ?>
<article class="uk-article">
<h2 class="uk-article-title">
<a class="uk-link" href="<?= ( $listhref . $item[slug] ) ?>">
<?= escapeOutput( $item[title] ) ?>
</a>
</h2>
<p class="uk-article-meta"><?= escapeOutput( $item[datum] ) ?></p>
<p class="uk-article-lead"><?= escapeOutput( $item[summary] ) ?></p>
</article>
<hr class="uk-article-divider">
<?php }
