<?php
class News{
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getNewsForHomes(){
        $this->db->query('SELECT * FROM news where language = :language ORDER BY created_at DESC LIMIT 3');
        $this->db->bind(':language',LANG);
        $result = $this->db->resultSet();
        return $result;
    }
}