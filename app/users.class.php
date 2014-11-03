<?php

class Users {


    function __construct($app,$db) {
        $this->db = $db;
        $this->app = $app;
    }

    function getUser($id){
        $menus=$this->db->exec('SELECT * FROM `users` WHERE id=?',$id);
        foreach($menus as $menu){
            $return[] = array(
                'id' => $menu['id'],
                'name' => $menu['name'],
                'description' => $menu['description'],
                'price' => $menu['price'],
                'currency' => $menu['currency'],
                'quantity' => $menu['quantity'],
                'active' => $menu['active'],
                'beverage' => $this->getBeverage($menu['id_beverage']),
                'courses' => $this->getCourses($menu['id'])
            );
        }

        return array('users'=>$return);
    }

	function getAllUsers(){
        $menus=$this->db->exec('SELECT * FROM `users`');
        foreach($users as $user){
            $return[] = array(
                'id' => $menu['id'],
                'name' => $menu['name'],
                'description' => $menu['description'],
                'price' => $menu['price'],
                'currency' => $menu['currency'],
                'quantity' => $menu['quantity'],
                'active' => $menu['active'],
                'beverage' => $this->getBeverage($menu['id_beverage']),
                'courses' => $this->getCourses($menu['id'])
            );
        }

        return array('users'=>$return);
	}


}
