<?php
class Logo_admin{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLogos(){
        $this->db->query('SELECT * FROM logos');

        $result = $this->db->resultSet();
        return $result;
    }

    public function getLogoForMenu(){
        $this->db->query("SELECT * FROM logos WHERE page = 'menu' ");
        
        $result = $this->db->single();
        return $result;   
    }

    public function getLogoForIndex(){
        $this->db->query("SELECT * FROM logos WHERE page = 'index' ");

        $result = $this->db->resultSet();
        return $result;
    }

    public function addLogo($data){
        $arr = implode(",", array_keys($data));
        $ArrVal = (':'.implode(", :", array_keys($data)));

        $this->db->query("INSERT INTO logos ($arr) VALUES ($ArrVal)");

        foreach($data as $key => $value){
            $this->db->bind(":$key", $value);
        }

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getLogoById($id){
        $this->db->query('SELECT * FROM logos WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function editLogo($data){
        $this->db->query('UPDATE logos SET  img_name = :img_name, en_title = :en_title, en_subtitle = :en_subtitle, ge_title = :ge_title, ge_subtitle = :ge_subtitle,
         ru_title = :ru_title, ru_subtitle = :ru_subtitle, page = :page WHERE id = :id');
        // bind value
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':img_name',$data['img_name']);
        $this->db->bind(':en_title', $data['en_title']);
        $this->db->bind(':en_subtitle', $data['en_subtitle']);
        $this->db->bind(':ge_title', $data['ge_title']);
        $this->db->bind(':ge_subtitle', $data['ge_subtitle']);
        $this->db->bind(':ru_title', $data['ru_title']);
        $this->db->bind(':ru_subtitle', $data['ru_subtitle']);
        $this->db->bind(':page', $data['page']);
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteLogo($id){
        $this->db->query('DELETE FROM logos WHERE id = :id');
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