<?php

//! Base controller
class ApiController {

    protected $db;


    //! HTTP route pre-processor
    function beforeroute($app) {
        $db=$this->db;
    }

    //! HTTP route post-processor
    function afterroute($app) {}

    //! Instantiate class
    function __construct() {
	    $app=Base::instance();

	    // authentication
	    $query = parse_url($app->get('PARAMS')[0]);
        $explodedQuery = explode('&',$query['query']);
        $received_signature = '';
        foreach($explodedQuery as $param){

            $pos = strpos($param, 's=');
            if($pos === 0){
                $received_signature = str_replace('s=','',$param);
            }
        }

        $message = $app->get('apiMessage');
        $private_key = $app->get('apiPrivateKey');

        $computed_signature = base64_encode(hash_hmac('sha1', $message, $private_key, TRUE));
        if($computed_signature != $received_signature){
            http_response_code(401);
            exit;
        }else{
            http_response_code(200);
        }

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
