<!-- footer -->
<div class="uk-block uk-contrast">
<div class="uk-container uk-container-center">
<footer class="uk-text-center">
<div class="uk-panel">
<p>
<?= escapeOutput( $site['name'] ) ?><br>
<?= translate( 'Powered by', $page['lang'] ) ?>
&nbsp;<a class="uk-link" href="/admin/login">CMSZPK</a>
</p>
<?php if ( $vars['development'] )
printf( "<p>Response completed in %.4f seconds</p>", microtime( true ) - $_SERVER['REQUEST_TIME'] );
?>
<p>
<a class="uk-button uk-button-small uk-button-primary" href="#"
title="<?= translate( 'To top', $page['lang'] ) ?>" data-uk-smooth-scroll="">
<span class="uk-icon-chevron-up"></span></a>
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
<?php foreach ( $langnav as $item ) { ?>
<li><a href="<?= $item['slug'] ?>"><?= getLangName( $item['lang'] ) ?></a></li>
<?php } ?>
</ul>
</div>
</div>
</body>
</html>
