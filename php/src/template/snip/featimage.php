<!-- media -->
<?php if ( !empty( $page['media'] )) { ?>
<div data-uk-scrollspy="{cls:'uk-animation-fade'}">
<div class="uk-cover-background"
style="height:600px;background-image:url('<?= \Sustav\Funkcije::escapeOutput( $page['media'] ) ?>');">
</div>
</div>
<?php }
