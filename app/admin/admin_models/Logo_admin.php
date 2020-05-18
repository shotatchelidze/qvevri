<?php
class Logo_admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLogos()
    {
        $this->db->query('SELECT * FROM logos WHERE language = :language');
        $this->db->bind(':language', LANG);

        $result = $this->db->resultSet();
        return $result;
    }

    // public function getLogoForPages($page)
    // {
    //     $this->db->query("SELECT * FROM logos WHERE page = '$page' ");

    //     $result = $this->db->single();
    //     return $result;
    // }

    public function getLogoById($item_id)
    {
        $this->db->query('SELECT * FROM logos WHERE item_id = :item_id');
        // Bind value
        $this->db->bind(':item_id', $item_id);

        $row = $this->db->resultSet();

        return $row;
    }

    public function getLogoImageNameById($id)
    {
        $this->db->query('SELECT logos.img_name FROM logos WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function addLogo($data)
    {
        $insertOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query("INSERT INTO logos (img_name,title,subtitle,page,language) VALUES (:img_name,:title,:subtitle,:page,:language)");

            $this->db->bind(':img_name', $data['img_name']);
            $this->db->bind(':title', $data["$lang" . '_title']);
            $this->db->bind(':subtitle', $data["$lang" . '_subtitle']);
            $this->db->bind(':page', $data['page']);
            $this->db->bind(':language', $lang);
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            // ბოლოს დამატებულის id 
            $this->db->query('SELECT max(id) FROM logos');
            $result = $this->db->singleColumn();
            // $result არის ბოლოს დამატებული news_ის id და $result-$i ხდება ერთიდაიგივე $item_id_ის მინიჭება
            $this->db->query("UPDATE logos SET item_id = $result-$i WHERE id = $result");
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            $i++;
        }
        return $insertOk;
    }

    public function updateLogo($data)
    {
        $updateOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query('UPDATE logos SET img_name = :img_name, title = :title, subtitle = :subtitle, page = :page WHERE id = :id');

            $this->db->bind(':img_name', $data[$i]['img_name']);
            $this->db->bind(':title',$data[$i]["$lang".'_title']);
            $this->db->bind(':subtitle', $data[$i]["$lang".'_subtitle']);
            $this->db->bind(':page',$data[$i]['page']);
            $this->db->bind(':id',$data[$i]["$lang".'_id']);

            if(!$this->db->execute()){
                $updateOk = false;
            break;
            }
            $i++;
        }
        return $updateOk;
    }

    public function deleteLogo($item_id)
    {
        $this->db->query('DELETE FROM logos WHERE item_id = :item_id');
        // Bind value
        $this->db->bind(':item_id', $item_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
