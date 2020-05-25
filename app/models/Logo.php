<?php
class Logo{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLogos($page){
        $this->db->query("SELECT
                            *    
                            FROM logos 
                            WHERE page = :page and language = :language");
        $this->db->bind(':language', LANG);
        $this->db->bind(':page', $page);

        $result = $this->db->resultSet();
        return $result;
    }

    public function getSingleLogo($page){
        $this->db->query("SELECT
                            *    
                            FROM logos 
                            WHERE page = :page and language = :language");
        $this->db->bind(':language', LANG);
        $this->db->bind(':page', $page);

        $result = $this->db->single();
        return $result;
    }

    public function getLogosForMenu(){
        $this->db->query("SELECT
                            *    
                            FROM logos 
                            WHERE page = 'menu' AND language = :language");
        $this->db->bind(':language', LANG);

        $result = $this->db->single();
        return $result;
    }
}