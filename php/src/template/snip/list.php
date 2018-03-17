<!-- list -->
<?php foreach ( $list as $item ) { ?>
<article class="uk-article">
<h2 class="uk-article-title">
<a class="uk-link" href="<?= ( $listhref . $item['slug'] ) ?>">
<?= \Sustav\Funkcije::escapeOutput( $item['title'] ) ?>
</a>
</h2>
<p class="uk-article-meta"><?= \Sustav\Funkcije::escapeOutput( $item['datum'] ) ?></p>
<p class="uk-article-lead"><?= \Sustav\Funkcije::escapeOutput( $item['summary'] ) ?></p>
</article>
<hr class="uk-article-divider">
<?php }
