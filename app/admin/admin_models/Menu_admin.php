<?php
class Menu_admin{
    private $db;
    
    public function __construct(){
        $this->db = new Database();        
    }

    public function getMenu(){
        $this->db->query('SELECT *
                            FROM menus 
                        ');
        $result = $this->db->resultSet();

        return $result;                
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


    
    public function updateMenu($data){
        $execute = false;
        $elementSize = sizeof($data['id']);

        for($i = 0; $i < $elementSize; $i++){
            $id = $data['id'][$i];
            $en_title = $data['en_title'][$i];
            $ge_title = $data['ge_title'][$i];
            $ru_title = $data['ru_title'][$i];
            
            $this->db->query('UPDATE menus SET en_title = :en_title, ge_title = :ge_title, ru_title = :ru_title WHERE id = :id');
            // Bind Value
            $this->db->bind(':id', $id);
            $this->db->bind(':en_title',$en_title);
            $this->db->bind(':ge_title',$ge_title);
            $this->db->bind(':ru_title',$ru_title);
            // execute statement
            $execute = $this->db->execute();
            if($execute === false){
                break;
            }
        }

        if($execute){
            return true;
        }else{
            return false;
        }
    }
}