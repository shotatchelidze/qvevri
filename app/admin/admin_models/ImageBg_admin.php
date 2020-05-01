<?php
class ImageBg_admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getImageBgs(){
        $this->db->query('SELECT * FROM imagebgs');

        $result = $this->db->resultSet();
        return $result;
    }

    public function getImageBgById($id){
        $this->db->query('SELECT * FROM imagebgs WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function addImageBg($data)
    {
        $arr = implode(",", array_keys($data));
        $ArrVal = (':' . implode(", :", array_keys($data)));

        $this->db->query("INSERT INTO imagebgs ($arr) VALUES ($ArrVal)");

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editImageBg($data){
        $this->db->query('UPDATE imagebgs SET image_name = :image_name, page_name = :page_name WHERE id = :id');
        // Bind value
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':image_name', $data['image_name']);
        $this->db->bind(':page_name', $data['page_name']);
        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteImageBg($id){
        $this->db->query('DELETE FROM imagebgs WHERE id = :id');
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
