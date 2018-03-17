<!-- users -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<table class="uk-table uk-table-striped">
<caption>Table users</caption>
<thead class="uk-text-bold">
<tr>
<td class="uk-width-2-10">Username</td>
<td class="uk-width-8-10">E-mail</td>
</tr>
</thead>
<tfoot>
<tr>
<td><a class="uk-link" href="/admin/users/new">Add new</a></td>
</tr>
</tfoot>

<tbody>
<?php
use Sustav\Funkcije;
foreach ( $list as $item ) {
    echo '<tr>'
        , '<td>'
        , '<a class="uk-link" href="/admin/users/'
        , Funkcije::escapeOutput( $item['id'] ), '">'
        , Funkcije::escapeOutput( $item['username'] ), '</a>'
        , '</td>'
        , '<td>', Funkcije::escapeOutput( $item['email'] ), '</td>'
        , '</tr>', PHP_EOL;
} ?>
</tbody>
</table>

</div>
</div>
</div>
