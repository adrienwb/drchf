<?php

$superusers = $this->db->exec('SELECT * FROM superusers');

$tableBodyTr = '';
foreach($superusers as $superuser){
    $tableBodyTr .= '<tr>';
    $tableBodyTr .= sprintf('<td><a href="#" id="real_name" class="editable" data-type="text" data-pk="%d" data-url="/admind/ajax?m=superuser" data-title="Modify username">%s</a></td>',$superuser['id'],$superuser['real_name']);
    $tableBodyTr .= '<td>'.$superuser['email'].'</td>';
    $tableBodyTr .= '<td>*</td>';
    $tableBodyTr .= '<td>'.$superuser['lang'].'</td>';
    $tableBodyTr .= '<td>'.$superuser['creation_date'].'</td>';
    $tableBodyTr .= '</tr>'."\r";
}
$app->set('tableBodyTr',$tableBodyTr);