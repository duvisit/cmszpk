<!-- feature staff -->
<?php if ( $featstaff !== false && !empty( $featstaff )) { ?>
<div data-uk-scrollspy="{cls:'uk-animation-fade'}">
<div class="uk-cover-background"
style="height:400px; background-image:url('<?= escapeOutput( $featstaff ) ?>');">
</div>
</div>
<?php }
