<!-- Facebook feed -->
<div class="uk-block">
<div class="uk-container uk-container-center">
<h1><?= \Sustav\Funkcije::escapeTrans( 'News', $page['lang'] ) ?></h1>
<h2><a style="" href="<?= $vars['facebook_url'] ?>">Facebook</a></h2>
<div class="uk-block uk-padding-bottom-remove">
<div class="uk-grid uk-container-center" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<?php \Sustav\Model\Facebook::feed( $fbnum, $page['lang'] ) ?>
</div>
</div>
</div>
</div>
