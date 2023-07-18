<?php

namespace App\Models;

use App\Helpers\ProductAbstract;
use App\Models\Product;

class Book extends ProductAbstract
{   
    protected $type = 'book';
    protected $weight;

    protected $validProperties = [
        'sku',
        'name',
        'price',
        'weight',
        // ... and so on for DVD-specific properties ...
    ];

    public function getType(): string
    {
        return $this->type;
    }

    // public function setType(int $type): void
    // {
    //     $this->type = $type;
    // }

    public function getTable(): string
    {
        return 'products_main';
    }


    public function setWeight(int $weight): void
    {
        $this-> weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function save(): bool
    {
        $this->db->query("INSERT INTO " . $this->getTable() . " (product_sku, product_name, product_price, product_type, book_weight) VALUES (:product_sku, :product_name, :product_price, :product_type, :book_weight)");

        // Bind the values from the parent class
        $this->db->bind(':product_sku', $this->getSku());
        $this->db->bind(':product_name', $this->getName());
        $this->db->bind(':product_price', $this->getPrice());
        $this->db->bind(':product_type', $this->getType());

        // Bind the values specific to the Furniture class
        $this->db->bind(':book_weight', $this->getWeight());

        return $this->db->execute();
    }
}
