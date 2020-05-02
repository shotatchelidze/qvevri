<?php
class Section_admin{

    private $db;

    public function __construct()
    {
        $this->db = new Database;    
    }

    public function getSections(){
        $this->db->query('SELECT * FROM sections');

        $result = $this->db->resultSet();
        return $result;
    }

    public function getSectionById($id){
        $this->db->query('SELECT * FROM sections WHERE id = :id');
        // Bind
        $this->db->bind(':id', $id);

        $row = $this->db->single();
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
        $arr = implode(",", array_keys($data));
        $ArrVal = (':'.implode(", :", array_keys($data)));

        $this->db->query("INSERT INTO sections ($arr) VALUES ($ArrVal)");

        foreach($data as $key => $value){
            $this->db->bind(":$key", $value);
        }

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function editSection($data){
        $this->db->query('UPDATE sections SET img_name = :img_name, bg_img_name = :bg_img_name, icon_img_name = :icon_img_name,
        en_title = :en_title, en_text = :en_text, ge_title = :ge_title, ge_text = :ge_text, ru_title = :ru_title, ru_text = :ru_text');

        $this->db->bind(':img_name', $data['img_name']);
        $this->db->bind(':bg_img_name', $data['bg_img_name']);
        $this->db->bind(':icon_img_name', $data['icon_img_name']);
        $this->db->bind(':en_title', $data['en_title']);
        $this->db->bind(':en_text', $data['en_text']);
        $this->db->bind(':ge_title', $data['ge_title']);
        $this->db->bind(':ge_text', $data['ge_text']);
        $this->db->bind(':ru_title', $data['ru_title']);
        $this->db->bind(':ru_text', $data['ru_text']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteSection($id){
        $this->db->query('DELETE FROM sections WHERE id = :id');
        // Bind value
        $this->db->bind(':id',$id);
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}