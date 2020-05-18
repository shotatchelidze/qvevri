<?php
class Section_admin{

    private $db;

    public function __construct()
    {
        $this->db = new Database;    
    }

    public function getSections(){
        $this->db->query('SELECT * FROM sections WHERE language = :language');
        $this->db->bind(':language', LANG);

        $result = $this->db->resultSet();
        return $result;
    }

    public function getSectionById($item_id){
        $this->db->query('SELECT * FROM sections WHERE item_id = :item_id');
        // Bind
        $this->db->bind(':item_id', $item_id);

        $row = $this->db->resultSet();
        return $row;
    }

    public function getSectionImageNamesById($id){
        $this->db->query('SELECT sections.img_name, sections.bg_img_name, sections.icon_img_name FROM sections WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function addSection($data){
        $insertOk = true;
        $i = 0;
        foreach(LANG_ARR as $lang => $language){
            $this->db->query("INSERT INTO sections (img_name, bg_img_name, icon_img_name, title, text, language) 
                                VALUES (:img_name, :bg_img_name, :icon_img_name, :title, :text, :language)");
            $this->db->bind(':img_name', $data['img_name']);
            $this->db->bind(':bg_img_name', $data['bg_img_name']);                    
            $this->db->bind(':icon_img_name', $data['icon_img_name']);                    
            $this->db->bind(':title', $data["$lang".'_title']);                    
            $this->db->bind(':text', $data["$lang".'_text']);                    
            $this->db->bind(':language', $lang);                    
            if(!$this->db->execute()){
                $insertOk = false;
            break;
            }
            // ბოლოს დამატებულის id 
            $this->db->query('SELECT max(id) FROM sections');
            $result = $this->db->singleColumn();
            // $result არის ბოლოს დამატებული section_ის id და $result-$i ხდება ერთიდაიგივე $item_id_ის მინიჭება
            $this->db->query("UPDATE sections SET item_id = $result-$i WHERE id = $result");
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            $i++;
        }
        return $insertOk;
    }

    public function updateSection($data){
        $updateOk = true;
        $i = 0;
        foreach(LANG_ARR as $lang => $language){
            $this->db->query('UPDATE sections SET img_name = :img_name, bg_img_name = :bg_img_name, icon_img_name = :icon_img_name,
                            title = :title, text = :text WHERE id = :id');
            $this->db->bind(':img_name',$data[$i]['img_name']);
            $this->db->bind(':bg_img_name',$data[$i]['bg_img_name']);                    
            $this->db->bind(':icon_img_name',$data[$i]['icon_img_name']);                    
            $this->db->bind(':title',$data[$i]["$lang".'_title']);
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

    public function deleteSection($item_id){
        $this->db->query('DELETE FROM sections WHERE item_id = :item_id');
        // Bind value
        $this->db->bind(':item_id',$item_id);
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}