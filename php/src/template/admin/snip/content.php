<!-- content -->
<div class="uk-form-row">
<label class="uk-form-label" for="content">Content</label>
</div>
<div class="uk-form-row">
<textarea id="content" name="content"
data-uk-htmleditor="{mode:'tab'}">
<?= \Sustav\Funkcije::purifyHtml( $page['content'] ) ?>
</textarea>
</div>
