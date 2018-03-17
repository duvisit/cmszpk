<?php if ( $featstaff !== false && !empty( $featstaff )) { ?>
<!-- feature staff -->
<div data-uk-scrollspy="{cls:'uk-animation-fade'}">
<div class="uk-cover-background"
style="height:400px; background-image:url('<?= \Sustav\Funkcije::escapeOutput( $featstaff ) ?>');">
</div>
</div>
<?php }
