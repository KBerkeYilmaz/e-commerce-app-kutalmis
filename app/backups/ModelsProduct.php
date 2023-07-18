<?php 
namespace App\Models;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use App\Libraries\Database;

class Product {
    private $db;

    protected $database_id; 

    public $product_name, $product_sku, $is_active, $type_id;  


    public function __construct()
    {
        $this->db = new Database;
    }


    // public function saveProduct($data) {
    //     $this->db->query("INSERT INTO products_main (product_sku, product_name, product_price, product_type) VALUES (:product_sku, :product_name, :product_price, :product_type");
    //     $this->db->bind(':product_sku', $data['product_sku']);
    //     $this->db->bind(':product_name', $data['product_name']);
    //     $this->db->bind(':product_price', $data['product_price']);
    //     $this->db->bind(':product_type', $data['product_type']);

    //     if ($this->db->execute()) {
    //         return ['product_sku' => $data['product_sku'], 'product_name' => $data['product_name'],'product_price' => $data['product_price'],'product_type' => $data['product_type']];
    //     } else {
    //         return false;
    //     }
    // }   
    public function saveProduct($data) {
        $this->db->query("INSERT INTO products_main (product_sku, product_name, product_price, product_type) VALUES (:product_sku, :product_name, :product_price, :product_type)");
        $this->db->bind(':product_sku', $data['product_sku']);
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':product_price', $data['product_price']);
        $this->db->bind(':product_type', $data['product_type']);
    
        if ($this->db->execute()) {
            return ['product_sku' => $data['product_sku'], 'product_name' => $data['product_name'],'product_price' => $data['product_price'],'product_type' => $data['product_type']];
        } else {
            return false;
        }
    }
    
    
    public function getProducts(){
        $this->db->query("SELECT * FROM products_main ORDER BY product_id");

        return $this->db->resultSet();
    }

    public function deleteProducts($data){
        
        $this->db->query("DELETE FROM products_main WHERE product_sku = :product_sku");
        $this->db->bind(':product_sku', $data['product_sku']);


        return $this->db->resultSet();
    }

    public function deleteAllProducts($data){
        
        $this->db->query("DELETE FROM products_main");
        $this->db->bind(':product_id', $data['product_id']);

        return $this->db->resultSet();
        
    }



}