<?php

namespace App\Helpers;

use App\Helpers\Product;

class Book extends Product
{
    private $weight;

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
        $this->db->query("INSERT INTO " . $this->getTable() . " (product_sku, product_name, product_price, product_type, weight) VALUES (:product_sku, :product_name, :product_price, :product_type, :weight)");

        // Bind the values from the parent class
        $this->db->bind(':product_sku', $this->getSku());
        $this->db->bind(':product_name', $this->getName());
        $this->db->bind(':product_price', $this->getPrice());
        $this->db->bind(':product_type', $this->getType());

        // Bind the values specific to the Furniture class
        $this->db->bind(':size', $this->getWeight());

        return $this->db->execute();
    }
}
