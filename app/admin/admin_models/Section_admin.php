<?php
class Section_admin{

    private $db;

    public function __construct()
    {
        $this->db = new Database;    
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
}