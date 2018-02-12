<!-- website -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<form id="article" class="uk-form uk-form-horizontal"
    action="<?php echoOutput( $uri ); ?>" method="post">

<input type="hidden" name="csrf" value="<?php echoOutput( $csrf ); ?>">

<fieldset>
<legend>Record</legend>

<div class="uk-form-row">
<label class="uk-form-label" for="lang">Language</label>
<div class="uk-form-controls">
<select id="lang" name="lang">
<?php foreach ( $langlist as $item ) {
    $value = escapeOutput( $item );
    $text = escapeOutput( getLangName( $item ));
    if ( $item === $page['lang'] )
        echo '<option value="', $value, '" selected>', $text, '</option>';
    else
        echo '<option value="', $value, '">', $text, '</option>';
} ?>
</select>
</div>
</div>

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

<div class="uk-form-row">
<label class="uk-form-label" for="name">Name</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="name" name="name"
    value="<?php echoOutput( $page['name'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="address">Address</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="address" name="address"
    value="<?php echoOutput( $page['address'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="zipcode">Postal code</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="zipcode" name="zipcode"
    value="<?php echoOutput( $page['zipcode'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="city">City</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="city" name="city"
    value="<?php echoOutput( $page['city'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="country">Country</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="country" name="country"
    value="<?php echoOutput( $page['country'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="phone">Phone</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="phone" name="phone"
    value="<?php echoOutput( $page['phone'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="logo">Logo</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="logo" name="logo"
    value="<?php echoOutput( $page['logo'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="description">Description</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="description" name="description"
    value="<?php echoOutput( $page['description'] ); ?>">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="comment">Comment</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="comment" name="comment"
    value="<?php echoOutput( $page['comment'] ); ?>">
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

