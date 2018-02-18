<!-- article -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<form id="article" class="uk-form uk-form-horizontal"
    action="<?php echoOutput( $uri ); ?>" method="post">

<input type="hidden" name="csrf" value="<?php echoOutput( $csrf ); ?>">

<fieldset>
<legend>Record</fieldset>

<div class="uk-form-row">
<label class="uk-form-label" for="lang">Language</label>
<div class="uk-form-controls">
<select id="lang" name="lang">
<?php foreach ( $langlist as $item ) {
    $str = escapeOutput( $item );
    if ( $item === $page['lang'] )
        echo '<option value="', $str, '" selected>', $str, '</option>';
    else
        echo '<option value="', $str, '">', $str, '</option>';
} ?>
</select>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="media">Featured image</label>
<div class="uk-form-controls">
<select id="mediasel" name="media" onchange="changeImage()">
<?php
$imgsrc = $page['media'];
if ( empty( $page['media'] )) {
    $imgsrc = '/media/placeholder.svg';
    echo '<option value="" selected>None</option>';
    foreach ( $medialist as $item ) {
        $str = escapeOutput( $item );
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

<div class="uk-form-row">
<label class="uk-form-label" for="keywords">Keywords</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="keywords" name="keywords"
    value="<?php echoOutput( $page['keywords'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="content">Content</label>
</div>

<div class="uk-form-row">
<textarea id="content" name="content"
    data-uk-htmleditor="{mode:'tab'}">
<?php echoHtml( $page['content'] ); ?>
</textarea>
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

