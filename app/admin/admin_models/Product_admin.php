<?php
class Product_admin{
    public function __construct()
    {
        $this->db = new Database;
        
    }

    public function getProducts($this_page_first_result, $results_per_page){
        $this->db->query("SELECT * FROM products 
                            WHERE language = :language 
                            ORDER BY products.created_at DESC
                            LIMIT :this_page_first_result, :results_per_page");
        $this->db->bind(':this_page_first_result', $this_page_first_result);
        $this->db->bind(':results_per_page', $results_per_page);
        $this->db->bind(':language',LANG);
        
        return $this->db->resultSet();
    }

    public function getProductById($item_id)
    {
        $this->db->query('SELECT * FROM products WHERE item_id = :item_id');
        // Bind value
        $this->db->bind(':item_id', $item_id);

        $results = $this->db->resultSet();
        return $results;
    }

    public function getImageName($item_id)
    {
        $this->db->query('SELECT img_name FROM products WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);
        $result = $this->db->single();
        return $result;
    }

    public function addProduct($data)
    {
        
        $insertOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query("INSERT INTO products (img_name,product_name,title,text,quantity,serial_number,language) 
                                VALUES (:img_name,:product_name,:title,:text,:quantity,:serial_number,:language)");

            $this->db->bind(':img_name', $data['img_name']);
            $this->db->bind(':product_name', $data["$lang".'_product_name']);
            $this->db->bind(':title', $data["$lang" . '_title']);
            $this->db->bind(':text', $data["$lang" . '_text']);
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':serial_number', $data['serial_number']);
            $this->db->bind(':language', $lang);
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            $this->db->query('SELECT max(id) FROM products');
            $result = $this->db->singleColumn();
            // $result is last added news id, and $result-$i is item_id in news table.
            $this->db->query("UPDATE products SET item_id = $result-$i WHERE id = $result");
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            $i++;
        }
        return $insertOk;
    }

    public function updateProduct($data)
    {
        $updateOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query('UPDATE products SET img_name = :img_name,product_name = :product_name,quantity = :quantity,
                                serial_number = :serial_number, title = :title, text = :text WHERE id = :id');

            $this->db->bind(':img_name', $data[$i]['img_name']);
            $this->db->bind(':product_name', $data[$i]["$lang".'_product_name']);
            $this->db->bind(':title', $data[$i]["$lang" . '_title']);
            $this->db->bind(':text', $data[$i]["$lang" . '_text']);
            $this->db->bind(':quantity', $data[$i]['quantity']);
            $this->db->bind(':serial_number', $data[$i]['serial_number']);
            $this->db->bind(':id',$data[$i]["$lang".'_id']);
            
            if(!$this->db->execute()){
                $updateOk = false;
            break;
            }
            $i++;
        }
        return $updateOk;
    }

    public function deleteProduct($item_id)
    {
        $this->db->query('DELETE FROM products WHERE item_id = :item_id');
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