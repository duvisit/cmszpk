<!-- source -->
<div class="uk-form-row">
<label class="uk-form-label" for="sourceid">Source</label>
<div class="uk-form-controls">
<select id="sourceid" name="sourceid">
<?php
    echo '<option value="0">None</option>';
    foreach ( $sourcelist as $item ) {
        $id = escapeOutput( $item['id'] );
        $title = escapeOutput( $item['title'] );
        if ( $item['id'] === $page['sourceid'] )
            echo '<option value="', $id, '" selected>', $title, '</option>';
        else
            echo '<option value="', $id, '">', $title, '</option>';
} ?>
</select>
</div>
</div>
