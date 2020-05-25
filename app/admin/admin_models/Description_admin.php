<?php
class Description_admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDescriptionForSection(){
        $this->db->query("SELECT * FROM descriptions WHERE page_name = 'home' and language = :language ");
        $this->db->bind(':language', LANG);
        $result = $this->db->single();
        return $result;
    }

    public function getDescriptionById($item_id){
        $this->db->query("SELECT * FROM descriptions WHERE item_id = $item_id");
        $result = $this->db->resultSet();
        return $result;
    }

    public function updateDescription($data){
        $updateOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query('UPDATE descriptions SET  title = :title, subtitle = :subtitle, text = :text WHERE id = :id');

            $this->db->bind(':title',$data[$i]["$lang".'_title']);
            $this->db->bind(':subtitle', $data[$i]["$lang".'_subtitle']);
            $this->db->bind(':text',$data[$i]["$lang".'_text']);
            $this->db->bind(':id',$data[$i]["$lang".'_id']);

            if(!$this->db->execute()){
                $updateOk = false;
            break;
            }
            $i++;
        }
        return $updateOk;
    }

}
