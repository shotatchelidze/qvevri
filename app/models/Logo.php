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
                            logos.".LANG."_title as logos_title,
                            logos.".LANG."_subtitle as logos_subtitle    
                            FROM logos 
                            WHERE page = 'menu'");
        $result = $this->db->resultSet();
        return $result;
    }
}