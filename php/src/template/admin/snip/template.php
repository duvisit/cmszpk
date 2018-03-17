<!-- template -->
<div class="uk-form-row">
<label class="uk-form-label" for="template">Template</label>
<div class="uk-form-controls">
<select id="template" name="template">
<?php foreach ( $vars['templates'] as $item ) {
    $str = \Sustav\Funkcije::escapeOutput( $item );
    if ( $item === $page['template'] )
        echo '<option value="', $str, '" selected>', $str, '</option>';
    else
        echo '<option value="', $str, '">', $str, '</option>';
} ?>
</select>
</div>
</div>
