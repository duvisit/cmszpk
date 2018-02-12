<!-- page -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<table class="uk-table uk-table-striped">
<caption>Table page</caption>
<thead class="uk-text-bold">
<tr>
<td class="uk-width-1-10">Menu ID</td>
<td class="uk-width-1-10">Language</td>
<td class="uk-width-2-10">Date</td>
<td class="uk-width-3-10">Title</td>
<td class="uk-width-3-10">Source</td>
</tr>
</thead>
<tfoot>
<td><a class="uk-link" href="/admin/page/new">Add new</a></td>
<td></td>
<td></td>
</tfoot>

<tbody>
<?php
foreach ( $list as $item ) {
    echo '<tr>'
        . '<td>' . escapeOutput( $item['menuid'] ) . '</td>'
        . '<td>' . escapeOutput( $item['lang'] ) . '</td>'
        . '<td>' . escapeOutput( $item['datum'] ) . '</td>'
        . '<td>'
        . '<a class="uk-link" href="/admin/page/'
        . escapeOutput( $item['id'] ) . '">'
        . escapeOutput( $item['title'] ) . '</a>'
        . '</td>'
        . '<td>' . escapeOutput(
            \Sustav\Model\Model::getSourceTitle(
            $vars['database'], 'page', $item['sourceid'] )) . '</td>'
        . '</tr>' . PHP_EOL;
} ?>
</tbody>

</table>

</div>
</div>
</div>

