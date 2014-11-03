<?php

//! Admin back-end processor
class Api extends ApiController {
	protected $result;
	private $ts_start,$ts_end;


	//! HTTP route pre-processor
	function beforeroute($app) {
		$this->ts_start = microtime(true);
	}

	function afterroute($app){
		$this->ts_end = microtime(true);
		$execution_time = ($this->ts_end - $this->ts_start);

		$count = count($this->result[key($this->result)]);

		$return = array(
			'result' => array(
				'duration' =>  round($execution_time,4).' seconds',
				'count' => $count,
				'data' => $this->result,
			)
		);
		echo json_encode($return);
	}

	function getUsers($app,$params){
		echo json_encode(array('id'=>$params['id'],'test'=>'menu'));
	}

	function getUser($app,$params){
		echo json_encode(array('id'=>$params['id'],'test'=>'menu'));
	}

	function getMenus($app){
		$menus = new Menus($app,$this->db);
		$this->result = $menus->getAllMenus();
	}


	function getMenu($app,$params){
		$menus = new Menus($app,$this->db);
		$this->result = $menus->getMenu($params['id']);
	}
}
