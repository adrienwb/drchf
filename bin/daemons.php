<?php
$app = require('../framework/f3/lib/base.php');
require('../framework/config.php');
require('../framework/routes.php');
require('../framework/site.php');

$db = $app->get('dbx');

if($argc !== 2){
    die("USAGE: php daemon.php <script>\r\n");
}

while(TRUE){
    require dirname(__FILE__) . '/daemons.'.$argv['1'].'.php';
    sleep(10);
}