<?php
class Section{
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSections(){
        $this->db->query('SELECT * FROM sections where language = :language');
        $this->db->bind(':language',LANG);
        $result = $this->db->resultSet();
        return $result;
    }
}