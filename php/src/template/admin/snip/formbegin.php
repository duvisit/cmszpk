<!-- form begin -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">
<form id="article" class="uk-form uk-form-horizontal"
action="<?= \Sustav\Funkcije::escapeOutput( $uri ) ?>" method="post">
<input type="hidden" name="csrf" value="<?= \Sustav\Funkcije::escapeOutput( $csrf ) ?>">
<fieldset><legend>Record</legend>
