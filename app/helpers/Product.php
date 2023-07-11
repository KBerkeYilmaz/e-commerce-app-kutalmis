<?php

namespace App\Helpers;
use App\Helpers\Furniture;
use App\Libraries\Database;

abstract class Product {
    

    protected $db;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;


    public function __construct()
    {
        $this->db = new Database;
    }


    public function getTable(): string
    {
        return 'products_main';
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getType(): string
    {
        return $this->type;
    }
    

    public function setType(string $type): void
    {
        $this->type = $type;
    }
    

    public function getAll()
    {
        $this->db->query("SELECT * FROM " . $this->getTable() . " ORDER BY product_id");
        return $this->db->resultSet();
    }

    public function delete($data)
    {
        $this->db->query("DELETE FROM " . $this->getTable() . " WHERE product_id = :product_id");
        $this->db->bind(':product_id', $data['product_id']);

        return $this->db->resultSet();
    }

    public function deleteAll($data)
    {
        $this->db->query("DELETE FROM " . $this->getTable());
        $this->db->bind(':product_id', $data['product_id']);

        return $this->db->resultSet();
    }


    abstract public function save(): bool;
}   
    
