<!-- Facebook feed -->
<section>
<div class="uk-block">
<div class="uk-container uk-container-center">

<?php if ( $page['lang'] === 'hr' ) {
    echo '<h1>Novosti</h1>', PHP_EOL;
} else {
    echo '<h1>News</h1>', PHP_EOL;
} ?>
<h2><a style="" href="<?= $vars['facebook_url'] ?>">Facebook</a></h2>

<div class="uk-block uk-padding-bottom-remove">
<div class="uk-grid uk-container-center"
    data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<?php \Sustav\Model\Facebook::feed( 3 ); ?>
</div>
</div>

</div>
</div>
<hr>
</section>
