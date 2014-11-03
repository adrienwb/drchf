<?php

//! Base controller
class Controller {

	protected $db;

	//! HTTP route pre-processor
	function beforeroute($app) {
		$db=$this->db;
		// Prepare user menu
		// $app->set('menu',
		// 	$db->exec('SELECT slug,title FROM pages ORDER BY position;'));
	}

	//! HTTP route post-processor
	function afterroute($app) {
		// Render HTML layout
		//echo Template::instance()->render('layout.htm');
	}

	//! Instantiate class
	function __construct() {
		$app=Base::instance();
		// Connect to the database
		$dsn = sprintf('mysql:host=%s;port=3306;dbname=%s',
			$app->get('db_host'),
			$app->get('db_dbname'));
		$db=new \DB\SQL($dsn,$app->get('db_username'),$app->get('db_password'));
		// Use database-managed sessions
		new DB\SQL\Session($db);
		// Save frequently used variables
		$this->db=$db;
	}

}
