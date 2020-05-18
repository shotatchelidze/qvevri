<?php
class Pagination_admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getResultPerPage($page_name){
        $this->db->query("SELECT result_per_page FROM paginations WHERE page_name = :page_name");
        $this->db->bind(':page_name', $page_name);
        $result = $this->db->singleColumn();
        return $result;
    }   
    
    public function updateResultPerPage($result_per_page,$page_name){
        $this->db->query("UPDATE paginations SET result_per_page = :result_per_page WHERE page_name = :page_name");
        $this->db->bind(':result_per_page',$result_per_page);
        $this->db->bind(':page_name',$page_name);

        if($this->db->execute())  return true;  else return false;
    }

    public function recordCount($page_name)
    {
        $this->db->query("SELECT $page_name.item_id FROM $page_name");
        $this->db->resultSet();

        $count = $this->db->rowCount();
        // შედეგი გავყოთ ენების რაოდენობაზე
        return $count / count(LANG_ARR);
    }
   
}
