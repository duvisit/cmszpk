<!-- article -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center uk-overflow-container">

<table class="uk-table uk-table-striped">
<caption>Table article</caption>
<thead class="uk-text-bold">
<tr>
<td class="uk-width-1-10">Language</td>
<td class="uk-width-2-10">Date</td>
<td class="uk-width-3-10">Title</td>
<td class="uk-width-3-10">Source</td>
</tr>
</thead>
<tfoot>
<tr>
<td><a class="uk-link" href="/admin/article/new">Add new</a></td>
</tr>
</tfoot>

<tbody>
<?php
use Sustav\Funkcije;
use Sustav\Model\Model;
foreach ( $list as $item ) {
    echo '<tr>'
        , '<td>', Funkcije::escapeOutput( $item['lang'] ), '</td>'
        , '<td>', Funkcije::escapeOutput( $item['datum'] ), '</td>'
        , '<td>'
        , '<a class="uk-link" href="/admin/article/'
        , Funkcije::escapeOutput( $item['id'] ), '">'
        , Funkcije::escapeOutput( $item['title'] ), '</a>'
        , '</td>'
        , '<td>'
        , Funkcije::escapeOutput( Model::getSourceTitle( $vars['database'], 'article', $item['sourceid'] ))
        , '</td>'
        , '</tr>', PHP_EOL;
} ?>
</tbody>
</table>

</div>
</div>
</div>
