<?php
$app = require(dirname(__FILE__).'/../framework/f3/lib/base.php');
require(dirname(__FILE__).'/../framework/config.php');
require(dirname(__FILE__).'/../framework/routes.php');
require(dirname(__FILE__).'/../framework/site.php');

$app->run();