<!-- website -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<table class="uk-table uk-table-striped">
<caption>Table website</caption>
<thead class="uk-text-bold">
<tr>
<td class="uk-width-1-10">Enabled</td>
<td class="uk-width-1-10">Language</td>
<td class="uk-width-1-10">Date</td>
<td class="uk-width-2-10">Title</td>
<td class="uk-width-5-10">Description</td>
</tr>
</thead>
<tfoot>
<tr>
<td><a class="uk-link" href="/admin/website/new">Add new</a></td>
</tr>
</tfoot>

<tbody>
<?php
use Sustav\Funkcije;
foreach ( $list as $item ) {
    echo '<tr>'
        , '<td>', Funkcije::escapeOutput( $item['enabled'] ), '</td>'
        , '<td>', Funkcije::escapeOutput( $item['lang'] ), '</td>'
        , '<td>', Funkcije::escapeOutput( $item['datum'] ), '</td>'
        , '<td>'
        , '<a class="uk-link" href="/admin/website/'
        , Funkcije::escapeOutput( $item['id'] ), '">'
        , Funkcije::escapeOutput( $item['name'] ), '</a>'
        , '</td>'
        , '<td>', Funkcije::escapeOutput( $item['description'] ), '</td>'
        , '</tr>', PHP_EOL;
} ?>
</tbody>
</table>

</div>
</div>
</div>
