<?php
class Product{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProducts(){
        $this->db->query("SELECT
                            products.id as product_id    
                            FROM products 
                            WHERE language = :language");
        $this->db->bind(':language', LANG);
        
        $result = $this->db->resultSet();
        return $result;
    }
}