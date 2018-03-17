<!-- form end -->
</fieldset>
<div class="uk-block">
<div class="uk-grid">
<div class="uk-width-medium-1-5">
<input class="uk-button uk-button-primary uk-text-contrast uk-width-1-1"
type="submit" name="save" value="Save">
</div>
<div class="uk-width-medium-1-5">
<a class="uk-button uk-button-secondary uk-width-1-1"
href="<?= \Sustav\Funkcije::escapeOutput( "/admin/$table" ) ?>">Cancel</a>
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
