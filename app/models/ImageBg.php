<?php
class ImageBg{
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getImageBg($page){
        $this->db->query('SELECT * FROM imagebgs where page_name = :page');
        $this->db->bind(':page',$page);
        $result = $this->db->resultSet();
        return $result;
    }

    
}