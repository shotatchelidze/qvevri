<?php
class News_model {
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

    public function getNews($this_page_first_result, $results_per_page){
        $this->db->query('SELECT * FROM news where language = :language ORDER BY created_at DESC LIMIT :this_page_first_result, :results_per_page');
        $this->db->bind(':language', LANG);
        $this->db->bind(':this_page_first_result',$this_page_first_result);
        $this->db->bind(':results_per_page', $results_per_page);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getSingleNews($item_id){
        $this->db->query('SELECT * FROM news where language = :language and item_id = :item_id ');
        $this->db->bind(':language', LANG);
        $this->db->bind(':item_id', $item_id);
        $result = $this->db->single();
        // თუ ჩანაწერი არ არსებობს დააბრუუნებს false_ს
        if($result===false){
        return $result;
        }
        $this->db->query('SELECT * FROM news_imgs WHERE news_id = :news_id');
        $this->db->bind(':news_id', $item_id);
        $img_result = $this->db->resultSet();
        $result->images = $img_result;
        return $result;    
    }
}