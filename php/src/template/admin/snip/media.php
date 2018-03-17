<!-- media -->
<div class="uk-form-row">
<label class="uk-form-label" for="media">Media</label>
<div class="uk-form-controls">
<select id="mediasel" name="media" onchange="changeImage()">
<?php
$imgsrc = $page['media'];
if ( empty( $page['media'] )) {
    $imgsrc = '/media/placeholder.svg';
    $str = \Sustav\Funkcije::escapeOutput( $item );
    echo '<option value="/media/placeholder.svg" selected>None</option>';
    foreach ( $medialist as $item ) {
        echo '<option value="', $str, '">', $str, '</option>';
    }
} else {
    echo '<option value="/media/placeholder.svg">None</option>';
    foreach ( $medialist as $item ) {
        $str = \Sustav\Funkcije::escapeOutput( $item );
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
    id="mediaimg" src="<?= \Sustav\Funkcije::escapeOutput( $imgsrc ) ?>">
</div>
</div>
