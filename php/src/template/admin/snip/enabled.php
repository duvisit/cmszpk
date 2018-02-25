<!-- enabled -->
<div class="uk-form-row">
<label class="uk-form-label" for="enabled">Enabled</label>
<div class="uk-form-controls">
<select id="enabled" name="enabled">
<?php if ( $page['enabled'] === 'yes' ) {
        echo '<option value="yes" selected>Yes</option>';
        echo '<option value="no">No</option>';
} else {
        echo '<option value="yes">Yes</option>';
        echo '<option value="no" selected>No</option>';
} ?>
</select>
</div>
</div>
