<?php
// mandrill
require_once 'vendors/mandrill-api-php/src/Mandrill.php';
$mandrill = new Mandrill($app->get('mandrill_key'));

// database
$dsn = sprintf('mysql:host=%s;port=3306;dbname=%s',
    $app->get('db_host'),
    $app->get('db_dbname'));
$dbx=new \DB\SQL($dsn,$app->get('db_username'),$app->get('db_password'));
// Use database-managed sessions
new DB\SQL\Session($dbx);
// Save frequently used variables
$app->set('dbx',$dbx);



