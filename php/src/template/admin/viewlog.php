<!-- view log -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container">
<p><a href="/admin/log/clean">Clean logs</a></p>
<h2>Error log</h2>
<pre>
<?php
$log = realpath( __DIR__.'/../../error.log' );
if ( file_exists( $log )) {
    \Sustav\Funkcije::echoOutput( file_get_contents( $log ));
}
?>
</pre>
<h2>Cache log</h2>
<pre>
<?php
$log = realpath( __DIR__.'/../../cache.log' );
if ( file_exists( $log )) {
    \Sustav\Funkcije::echoOutput( file_get_contents( $log ));
}
?>
</pre>
</div>
</div>
</div>
