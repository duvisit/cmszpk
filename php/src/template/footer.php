<!-- footer -->
<div class="uk-block uk-contrast">
<div class="uk-container uk-container-center">
<footer class="uk-text-center">
<div class="uk-panel">
<p>
<?= \Sustav\Funkcije::escapeOutput( $site['name'] ) ?><br>
<?= \Sustav\Funkcije::escapeTrans( 'Powered by', $page['lang'] ) ?>
&nbsp;<a class="uk-link" href="/admin/login">CMSZPK</a>
</p>
<p>
<a class="uk-button uk-button-small uk-button-primary" href="#"
title="<?= \Sustav\Funkcije::escapeTrans( 'To top', $page['lang'] ) ?>" data-uk-smooth-scroll="">
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
<li><a href="<?= $item['slug'] ?>"><?= \Sustav\Funkcije::getLangName( $item['lang'] ) ?></a></li>
<?php } ?>
</ul>
</div>
</div>
</body>
</html>
