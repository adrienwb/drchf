<?php

$menus = new Menus($app,$app->get('dbx'));
$results = $menus->getAllMenus();

$tableBodyTr = '';
foreach($results['menus'] as $result){
    $tableBodyTr .= '<tr>';
    $tableBodyTr .= '<td>'.$result['name'].'</td>';
    $tableBodyTr .= '<td>'.$result['description'].'</td>';
    $tableBodyTr .= '<td>'.$result['price'].$result['currency'].'</td>';
    $tableBodyTr .= '<td>'.$result['quantity'].'</td>';
    $tableBodyTr .= '<td>'.$result['creation_date'].'</td>';
    $tableBodyTr .= sprintf('
        <td>
            <button data-id="%d" data-action="edit" class="actions btn btn-default btn-xs" type="button">
                <i class="fa fa-pencil"></i>
            </button>
        </td>',$result['id'],$result['id']);
    $tableBodyTr .= '</tr>';
}
$app->set('tableBodyTr',$tableBodyTr);