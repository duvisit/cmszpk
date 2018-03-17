<!-- gallery -->
<?php include __DIR__.'/snip/media.php'; ?>
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<?= \Sustav\Funkcije::escapeHtml( $page['content'] ) ?>
<div class="uk-container uk-container-center">
<section class="uk-grid uk-container-center"
data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<?php include __DIR__.'/snip/medialist.php'; ?>
</section>
</div>
</div>
</div>
