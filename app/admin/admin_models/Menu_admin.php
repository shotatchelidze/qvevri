<?php
class Menu_admin{
    private $db;
    
    public function __construct(){
        $this->db = new Database();        
    }

    public function getMenu(){
        $this->db->query('SELECT * FROM menus WHERE language = :language');
        $this->db->bind(':language', LANG);
        $result = $this->db->resultSet();
        return $result;                
    }

    public function updateMenu($data){
        $execute = true;
        for($i = 0; $i < count($data['id']); $i++){
            $this->db->query('UPDATE menus SET title = :title WHERE id = :id');
            $this->db->bind(':title', $data['title'][$i]);
            $this->db->bind(':id', $data['id'][$i]);
            if(!$this->db->execute()){
                $execute = false;
            break;
            }
        }
        return $execute;
    }

    public function updateAdminPassword($data){
        $this->db->query('UPDATE admins SET password = :new_pass');
        // Bind Values
        $this->db->bind(':new_pass', $data['new_pass']);
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}