<!-- media -->
<?php if ( !empty( $page['media'] )) { ?>
<div data-uk-scrollspy="{cls:'uk-animation-fade'}">
<div class="uk-cover-background"
style="height:400px;background-image:url('<?= escapeOutput( $page['media'] ) ?>');">
</div>
</div>
<?php }
