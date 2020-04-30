<?php
class Logo_admin{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLogo(){
        $this->db->query("SELECT * FROM logos WHERE page = 'menu' ");
        
        $result = $this->db->single();
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

    public function updateLogo($data){
        $arr = implode(",", array_keys($data));
        $ArrVal = (' = '.':'.implode(":", array_keys($data)));
        
        $this->db->query('UPDATE logos SET  img_name = :img_name, en_title = :en_title, en_subtitle = :en_subtitle, ge_title = :ge_title, ge_subtitle = :ge_subtitle,
         ru_title = :ru_title, ru_subtitle = :ru_subtitle, page = :page WHERE id = :id');

        // dasamtavrebeli
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