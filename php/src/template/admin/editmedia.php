<!-- media -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<form id="media" class="uk-form uk-form-horizontal"
    action="<?php echoOutput( $uri ); ?>" method="post">

<input type="hidden" name="csrf" value="<?php echoOUtput( $csrf ); ?>">

<fieldset>
<legend>Record</legend>

<div class="uk-form-row">
<label class="uk-form-label" for="lang">Language</label>
<div class="uk-form-controls">
<select id="lang" name="lang">
<?php foreach ( $langlist as $item ) {
    $str = escapeOUtput( $item );
    if ( $item === $page['lang'] )
        echo '<option value="', $str, '" selected>', $str, '</option>';
    else
        echo '<option value="', $str, '">', $str, '</option>';
} ?>
</select>
</div>
</div>

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

<div class="uk-form-row">
<label class="uk-form-label" for="media">Media</label>
<div class="uk-form-controls">
<select id="mediasel" name="media" onchange="changeImage()">
<?php
$imgsrc = $page['media'];
if ( empty( $page['media'] )) {
    $imgsrc = '/media/placeholder.svg';
    $str = escapeOutput( $item );
    echo '<option value="" selected>None</option>';
    foreach ( $medialist as $item ) {
        echo '<option value="', $str, '">', $str, '</option>';
    }
} else {
    echo '<option value="">None</option>';
    foreach ( $medialist as $item ) {
        $str = escapeOutput( $item );
        if ( $item === $page['media'] )
            echo '<option value="', $str, '" selected>', $str, '</option>';
        else
            echo '<option value="', $str, '">', $str, '</option>';
    }
} ?>

</select>
</div>
</div>

<div class="uk-form-row">
<div class="uk-form-controls">
<img class="uk-thumbnail uk-thumbnail-small"
    id="mediaimg" src="<?php echoOutput( $imgsrc ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="title">Title</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="title" name="title"
    value="<?php echoOutput( $page['title'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="summary">Summary</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="summary" name="summary"
    value="<?php echoOutput( $page['summary'] ); ?>">
</div>
</div>

</fieldset>

<div class="uk-block">
<div class="uk-grid">
<div class="uk-width-medium-1-5">
<input class="uk-button uk-button-primary uk-text-contrast uk-width-1-1"
    type="submit" name="save" value="Save">
</div>
<div class="uk-width-medium-1-5">
<a class="uk-button uk-button-secondary uk-width-1-1"
    href="<?php echoOutput( "/admin/$table" ); ?>">Cancel</a>
</div>
<div class="uk-width-medium-3-5 uk-text-right">
<input class="uk-button uk-button-link" formnovalidate
    type="submit" name="delete" value="Delete this record">
</div>
</div>
</div>

</form>

</div>
</div>
</div>

