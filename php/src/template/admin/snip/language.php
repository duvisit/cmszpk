<!-- language -->
<div class="uk-form-row">
<label class="uk-form-label" for="lang">Language</label>
<div class="uk-form-controls">
<select id="lang" name="lang">
<?php foreach ( $langlist as $item ) {
    $str = \Sustav\Funkcije::escapeOutput( $item );
    if ( $item === $page['lang'] )
        echo '<option value="', $str, '" selected>', $str, '</option>';
    else
        echo '<option value="', $str, '">', $str, '</option>';
} ?>
</select>
</div>
</div>
