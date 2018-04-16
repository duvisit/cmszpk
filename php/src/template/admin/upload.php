<!-- media -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center uk-overflow-container">

<form id="media" class="uk-form uk-form-horizontal"
    enctype="multipart/form-data"
    action="/admin/upload" method="post">

<input type="hidden" name="csrf"
value="<?= \Sustav\Funkcije::escapeOUtput( $csrf ) ?>">

<fieldset>
<legend>Record</legend>

<div class="uk-form-row">
<label class="uk-form-label" for="lang">Language</label>
<div class="uk-form-controls">
<select name="lang">
<?php foreach ( $langlist as $item ) {
    $str = \Sustav\Funkcije::escapeOUtput( $item );
    echo '<option value="', $str, '">', $str, '</option>';
} ?>
</select>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="display">Display</label>
<div class="uk-form-controls">
<select name="display">
<?php foreach ( ['media','gallery','product'] as $item ) {
    echo '<option value="', $item, '">', $item, '</option>';
} ?>
</select>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="userfile">Media upload</label>
<div class="uk-form-controls">
<input type="hidden" name="MAX_FILE_SIZE" value="300000">
<input id="userfile" name="userfile" type="file" required>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="title">Title</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="title" name="title"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="summary">Summary</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="summary" name="summary"
    value="">
</div>
</div>

</fieldset>

<div class="uk-block">
<div class="uk-grid">
<div class="uk-width-medium-1-5">
<input class="uk-button uk-button-primary uk-text-contrast uk-width-1-1"
    type="submit" name="upload" value="Upload">
</div>
<div class="uk-width-medium-1-5">
<a class="uk-button uk-button-secondary uk-width-1-1" href="/admin/media">Cancel</a>
</div>
</div>
</div>

</form>

</div>
</div>
</div>
