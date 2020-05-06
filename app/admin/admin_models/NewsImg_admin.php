<?php
class NewsImg_admin{
    private $db;
    
    public function __construct(){
        $this->db = new Database();        
    }

    public function getNewsImgsByNewsId($news_id){
        $this->db->query('SELECT * FROM news_imgs WHERE news_id = :news_id');
        // Bind value
        $this->db->bind(':news_id', $news_id);

        $result = $this->db->resultSet();
        return $result;
    } 

    public function addNewsImg($data){
        $arr = implode(",", array_keys($data));
        $ArrVal = (':'.implode(", :", array_keys($data)));

        $this->db->query("INSERT INTO news_imgs ($arr) VALUES ($ArrVal)");

        foreach($data as $key => $value){
            $this->db->bind(":$key", $value);
        }

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteNewsImgs($id){
        $this->db->query('DELETE FROM news_imgs WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    
    }
}