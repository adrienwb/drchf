<?php
// Home page
$app->route('GET /','Home->display',$app->get('cache_static'));
$app->route('GET /app','Home->order');
$app->route('GET|POST /ajax','Home->ajax');

// Admin
$app->route('GET /admind','Admin->display');
$app->route('GET /admind/login','Admin->displayAuth');
$app->route('GET /admind/logout','Admin->logout');
$app->route('POST /admind/login','Admin->auth');
$app->route('GET /admind/pages','Admin->displayWrapperPage');
$app->route('GET /admind/ajax','Admin->ajax');

// Api
$app->set('apiRoutes',array(
    '/api/users'        => array('method' => 'GET','class' => 'Api->getUsers'),
    '/api/users/@id'    => array('method' => 'GET','class' => 'Api->getUser'),
    '/api/users/login'  => array('method' => 'GET','class' => 'Api->loginUser'),
    '/api/users/signup' => array('method' => 'POST','class' => 'Api->signupUser'),
    '/api/menus'        => array('method' => 'GET','class' => 'Api->getMenus'),
    '/api/menus/@id'    => array('method' => 'GET','class' => 'Api->getMenu'),
));
foreach($app->get('apiRoutes') as $k => $v){
    $route = $v['method'].' '.$k;
    $class = $v['class'];
    $app->route($route,$class);
}

// minifier
$app->route('GET /min/@type',
    function($app, $args) {
        echo Web::instance()->minify($_GET['files'],'','',sprintf('../public/assets/%s/',$args['type']));
    },
    3600*24
);
