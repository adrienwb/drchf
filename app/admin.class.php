<?php

//! Admin back-end processor
class Admin extends Controller {

	//! HTTP route pre-processor
	function beforeroute($app) {
		if($app->get('SERVER')['REQUEST_URI'] === '/admind'){
			if(!$app->get('SESSION.loggedin')){
				$app->reroute('/admind/login');
			}elseif($app->get('SESSION.loggedin')){
				$superuser=$this->db->exec(sprintf('SELECT * FROM superusers WHERE email = "%s"',$app->get('SESSION.email')));
				$app->set('superuser',$superuser['0']);
			}
		}
	}

	function auth($app){
		$post = $app->get('POST');
		$superuser = new \DB\SQL\Mapper($this->db, 'superusers');
		$auth = new \Auth($superuser, array('id'=>'email', 'pw'=>'password'));
		$login_result = $auth->login($post['email'],$post['password']);
		if($login_result){
			$app->set('SESSION.loggedin',TRUE, 3600);
			$app->set('SESSION.email',$post['email']);
			echo json_encode(array('status'=>'success'));
		}else{
			$app->set('SESSION.loggedin',FALSE);
			echo json_encode(array('status'=>'false'));
		}
	}

	function logout($app){
		$app->set('SESSION.loggedin',FALSE);
		$app->reroute('/admind/login');
	}

	function displayAuth($app) {
		if($app->get('SESSION.loggedin')){
			$app->reroute('/admind');
		}

		$app->set('content','admin_login.htm');
        echo Template::instance()->render('admin_layout.htm');
    }

	function display($app){
		$app->set('content','admin_content.htm');
		echo Template::instance()->render('admin_layout.htm');
	}

	function displayWrapperPage($app){
		$wrapper = str_replace('/admind/pages?module=','',$app->get('PARAMS')[0]);
		include "modules/$wrapper.php";
		echo Template::instance()->render("modules/$wrapper.htm");
	}

	function ajax($app){

	}



}
