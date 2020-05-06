<?php
class Menu{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMenu(){
        $this->db->query("SELECT  
                            menus.".LANG."_title as menuTitle,
                            menus.id as menuId
                            FROM menus 
                        ");
        $result = $this->db->resultSet();

        return $result;                
    }   
}