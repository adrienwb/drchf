<?php

class Home extends Controller {

	function error(){
		echo View::instance()->render('404.htm');
	}

	function display($app){
		$app->set('content','home_content.htm');
		echo View::instance()->render('home_layout.htm');
	}

    function order($app){
        $app->set('content','app_content.htm');
        echo View::instance()->render('app_layout.htm');

    }

    function ajax($app,$params){
        $url = parse_url($params['0']);
        $explodedUrl = explode('&',$url['query']);

        parse_str($url['query'],$output);

        foreach($explodedUrl as $param){
            $pos = strpos($param, 'email=');
            if($pos === 0){
                $email = str_replace('email=','',$param);
            }
        }

        $json = array();
        if($output['m'] === 'notify'){//notify me
            if($this->db->exec('INSERT INTO `emails_queue` (name,email) VALUES (?,?)',array(1=>'notify',2=>$email))){
                $json = array(
                    'status'=>'success',
                    'email'=>$email,
                    'message'=> sprintf('Invitation enregistrée pour %s, merci !',$email)
                );
            }else{
                $json = array('status'=>'error');
            }
        }else{
            $json = array('status'=>'error');
        }

        echo json_encode($json);
    }
}
