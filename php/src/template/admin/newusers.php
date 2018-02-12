<!-- users -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<form id="article" class="uk-form uk-form-horizontal"
    action="<?php echoOutput( $uri ); ?>" method="post">

<input type="hidden" name="csrf" value="<?= $csrf ?>">

<fieldset>
<legend>Record</legend>

<div class="uk-form-row">
<label class="uk-form-label" for="username">Username</label>
<div class="uk-form-controls">
<input class="uk-form-width-medium" required
    type="text" id="username" name="username"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="password">Password</label>
<div class="uk-form-controls">
<input class="uk-form-width-medium" required
    type="password" id="password" name="password">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="email">E-mail</label>
<div class="uk-form-controls">
<input class="uk-form-width-medium" required
    type="text" id="email" name="email"
    value="">
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
</div>
</div>

</form>

</div>
</div>
</div>

