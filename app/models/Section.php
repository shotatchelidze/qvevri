<?php 
class Section {
    
    public function __construct(){
        $this->db = new Database();
        
    }

    
    public function getSection(){
        
        $this->db->query("SELECT  
                            sections.".LANG."_title as sectionTitle 
                            FROM sections
                        ");

        $result = $this->db->resultSet();
        
        return $result;
    }
}