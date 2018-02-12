<!-- footer -->
<div class="uk-block uk-contrast">
<div class="uk-container uk-container-center">
<footer class="uk-text-center">

<div class="uk-panel">
<p>
<?php echoOutput( $site['name'] ); ?><br>
Powered by <a class="uk-link" href="/admin/login">CMSZPK</a>
</p>
<?php if ( $vars['development'] )
    printf( "<p>Response completed in %.4f seconds</p>\n",
        microtime( true ) - $_SERVER['REQUEST_TIME'] );
?>
<p>
<a class="uk-button uk-button-small uk-button-primary" href="#"
    data-uk-smooth-scroll=""><i class="uk-icon-chevron-up"></i></a>
</p>
</div>

</footer>
</div>
</div>

<!-- offcanvas menu -->
<div class="uk-offcanvas" id="offcanvas">
<div class="uk-offcanvas-bar">
<ul class="uk-nav uk-nav-offcanvas">
<?= $menulist ?>
<?php if ( isset( $langnav )) {
    foreach ( $langnav as $item )
        echo '<li><a href="' . $item['slug'] . '">'
        . getLangName( $item['lang'] )
        . '</a></li>';
    echo PHP_EOL;
} ?>
</ul>
</div>
</div>

</body>
</html>
