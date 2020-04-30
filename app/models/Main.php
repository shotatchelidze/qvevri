<?php
class Main{

    public function __construct(){
        $this->db = new Database();        
    }

    public function getMenu(){
        $this->db->query("SELECT  
                            menus.".LANG."_title as menuTitle,
                            id as menuId
                            FROM menus 
                        ");
        $result = $this->db->resultSet();

        return $result;                
    }   
}