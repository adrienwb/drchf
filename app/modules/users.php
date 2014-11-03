<?php
$users = $this->db->exec('SELECT id,username,email, first_name, last_name,birthdate FROM users');
$tableBodyTr = '';
foreach($users as $user){
    $tableBodyTr .= '<tr>';
    $tableBodyTr .= '<td>'.$user['username'].'</td>';
    $tableBodyTr .= '<td>'.$user['email'].'</td>';
    $tableBodyTr .= '<td>'.$user['first_name'].'</td>';
    $tableBodyTr .= '<td>'.$user['last_name'].'</td>';
    $tableBodyTr .= '<td>'.$user['birthdate'].'</td>';
    $tableBodyTr .= sprintf('
        <td>
            <button data-id="%d" data-action="edit" class="actions btn btn-default btn-xs" type="button">
                <i class="fa fa-pencil"></i>
            </button>
        </td>',$user['id'],$user['id']);
    $tableBodyTr .= '</tr>';
}
$app->set('tableBodyTr',$tableBodyTr);