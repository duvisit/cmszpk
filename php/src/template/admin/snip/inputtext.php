<!-- input text -->
<div class="uk-form-row">
<label class="uk-form-label" for="<?= $input['name'] ?>"><?= $input['label'] ?></label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
type="text" id="<?= $input['name'] ?>" name="<?= $input['name'] ?>"
value="<?= \Sustav\Funkcije::escapeOutput( $input['value'] ) ?>">
</div>
</div>
