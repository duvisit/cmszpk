<!-- media list -->
<?php foreach( $list as $item ) { ?>
<div class="uk-width-medium-1-3">
<div class="uk-panel">
<a href="<?= \Sustav\Funkcije::escapeOutput( $item['media'] ) ?>"
data-lightbox-type="image" data-uk-lightbox="{group:'group1'}"
title="<?= \Sustav\Funkcije::escapeOutput( $item['title'] ) ?>">
<img class="uk-thumbnail uk-thumbnail-medium"
src="<?= \Sustav\Funkcije::escapeOutput( $item['media'] ) ?>"
alt="<?= \Sustav\Funkcije::escapeOutput( $item['title'] ) ?>">
</a>
</div>
</div>
<?php }
