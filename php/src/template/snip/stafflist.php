<!-- staff list -->
<?php foreach ( $list as $item ) { ?>
<div class="uk-block">
<figure class="uk-overlay">
<img src="<?= escapeOutput( $item[media] ) ?>">
<figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom">
<h3 style="text-align:left;"><?= escapeOutput( $item[title] ) ?></h3>
<div class="uk-visible-large"><?= purifyHtml( $item[content] ) ?></div>
</figcaption>
</figure>
</div>
<?php }
