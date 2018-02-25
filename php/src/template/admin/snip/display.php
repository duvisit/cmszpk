<!-- display -->
<div class="uk-form-row">
<label class="uk-form-label" for="display">Display</label>
<div class="uk-form-controls">
<select name="display">
<?php foreach ( ['gallery','product','media'] as $item ) {
    if ( $item === $page['display'] )
        echo '<option value="' . $item . '" selected>' . $item . '</option>';
    else
        echo '<option value="' . $item . '">' . $item . '</option>';
} ?>
</select>
</div>
</div>
