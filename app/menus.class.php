<?php

class Menus {

    function __construct($app,$db) {
        $this->db = $db;
        $this->app = $app;
    }

    function getMenu($id){
        $menus=$this->db->exec('SELECT * FROM `menus` WHERE id=?',$id);
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

        return array('menus'=>$return);
    }

	function getAllMenus(){
        $menus=$this->db->exec('SELECT * FROM `menus`');
        foreach($menus as $menu){
            $return[] = array(
                'id' => $menu['id'],
                'name' => $menu['name'],
                'description' => $menu['description'],
                'price' => $menu['price'],
                'currency' => $menu['currency'],
                'quantity' => $menu['quantity'],
                'active' => $menu['active'],
                'creation_date' => $menu['creation_date'],
                'beverage' => $this->getBeverage($menu['id_beverage']),
                'courses' => $this->getCourses($menu['id'])
            );
        }

        return array('menus'=>$return);
	}

    function getBeverage($id){
        if($id){
            $beverage=$this->db->exec('SELECT * FROM `beverages` WHERE id=?',$id);

            $beverage_return = array(
                'id' => $beverage['0']['id'],
                'name' => $beverage['0']['name'],
                'image' => $beverage['0']['image'],
            );
        }else{
            $beverage_return = NULL;
        }

        return $beverage_return;
    }

    function getCourses($id){
        $courses_return = '';
        if($id){
            $courses=$this->db->exec('select courses.id, courses.name,courses.image,courses_type.name as type from `courses`
                LEFT JOIN rel_menus_courses
                ON rel_menus_courses.id_course = courses.id
                LEFT JOIN courses_type
                ON courses_type.id=courses.id_type
                WHERE rel_menus_courses.id_menu=?',$id);

            foreach($courses as $course){
                $courses_return[] = array(
                    'id' => $course['id'],
                    'name' => $course['name'],
                    'image' => $course['image'],
                    'type' => $course['type'],
                );
            }
        }else{
            $courses_return = NULL;
        }

        return $courses_return;
    }
}
