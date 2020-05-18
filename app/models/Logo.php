<?php
class Logo{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLogos($page){
        $this->db->query("SELECT
                            logos.id as logo_id,
                            logos.img_name as logo_image_name, 
                            logos.title as logo_title,
                            logos.subtitle as logo_subtitle    
                            FROM logos 
                            WHERE page = :page and language = :language");
        $this->db->bind(':language', LANG);
        $this->db->bind(':page', $page);

        $result = $this->db->resultSet();
        return $result;
    }
}