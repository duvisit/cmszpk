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
<?php if ( isset( $langnav )) {
    echo '<ul class="uk-navbar-nav uk-hidden-small uk-navbar-flip">';
    foreach ( $langnav as $item )
        echo '<li><a href="'
        . $item['slug'] . '">' . $item['lang'] . '</a></li>';
    echo '</ul>' . PHP_EOL;
} ?>
<a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""
    href="#offcanvas"></a>
<div class="uk-navbar-brand uk-navbar-center uk-visible-small">
<span class="uk-h2 uk-contrast"><?php echoOutput( $site['logo'] ); ?></span>
</div>

</div>
</nav>

