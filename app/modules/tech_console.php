<?php

foreach ($app->get('apiRoutes') as $key => $value) {
    $apiVerbs[] = "'".str_replace('/api','',$key)."'";
}
$apiArray = implode (',',$apiVerbs);
$app->set('apiArray',$apiArray);

$app->set('apiSignature',base64_encode(hash_hmac('sha1', $app->get('apiMessage'), $app->get('apiPrivateKey'), TRUE)));

