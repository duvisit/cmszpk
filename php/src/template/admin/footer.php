<!-- footer -->
<div class="uk-block uk-contrast">
<div class="uk-container uk-container-center">
<footer class="uk-text-center">

<div class="uk-panel">
<p>
<?php echoOutput( "Admin $table" ); ?><br>
Powered by CMSZPK
</p>
<p>
<?php
printf( "Response completed in %.4f seconds\n",
    microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'] );
?>
</p>
<p>
<a class="uk-button uk-button-small uk-button-primary" href="#"
    data-uk-smooth-scroll=""><i class="uk-icon-chevron-up"></i></a>
</p>
</div>

</footer>
</div>
</div>

<div class="uk-offcanvas" id="offcanvas">
<div class="uk-offcanvas-bar">
<ul class="uk-nav uk-nav-offcanvas">
<?= $menulist ?>
<li class=""><a class="uk-link" href="/admin/help">help</a></li>
<li class=""><a class="uk-link" href="/admin/logout">logout</a></li>
</ul>
</div>
</div>

</body>
</html>
