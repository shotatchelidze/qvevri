<?php
class Description
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDescription($page_name){
        $this->db->query('SELECT * FROM descriptions WHERE page_name = :page_name and language = :language');
        $this->db->bind(':page_name', $page_name);
        $this->db->bind(':language', LANG);
        $result = $this->db->single();
        return $result;
    }

}
