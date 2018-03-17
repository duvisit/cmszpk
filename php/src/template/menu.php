<!-- menu -->
<?php 
$menulist = '';
foreach ( $menu as $item ) {
    if ( $item['menuid'] == $menucurr ) {
        $menulist .= '<li class="uk-active"><a class="" href="'
            . $menulang . $item['slug'] . '">' . $item['title'] . '</a></li>'
            . PHP_EOL;
    } else {
        $menulist .= '<li class=""><a class="" href="'
            . $menulang . $item['slug'] . '">' . $item['title'] . '</a></li>'
            . PHP_EOL;
    }
} ?>
<nav class="uk-navbar" data-uk-sticky>
<div class="uk-container uk-container-center">
<ul class="uk-navbar-nav uk-hidden-small">
<?= $menulist ?>
</ul>
<ul class="uk-navbar-nav uk-hidden-small uk-navbar-flip">
<?php foreach ( $langnav as $item ) { ?>
<li><a href="<?= \Sustav\Funkcije::escapeOutput( $item['slug'] ) ?>">
<?= \Sustav\Funkcije::escapeOutput( $item['lang'] ) ?></a></li>
<?php } ?>
</ul>
<a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""
href="#offcanvas" title="Offcanvas"></a>
<div class="uk-navbar-brand uk-navbar-center uk-visible-small">
<span class="uk-h2 uk-contrast"><?= \Sustav\Funkcije::escapeOutput( $site['logo'] ) ?></span>
</div>
</div>
</nav>
