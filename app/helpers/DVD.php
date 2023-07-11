<?php

namespace App\Helpers;

use App\Helpers\Product;

class DVD extends Product
{
    private $size;


    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function save(): bool
    {
        $this->db->query("INSERT INTO " . $this->getTable() . " (product_sku, product_name, product_price, product_type, height, width, length) VALUES (:product_sku, :product_name, :product_price, :product_type, :size)");

        // Bind the values from the parent class
        $this->db->bind(':product_sku', $this->getSku());
        $this->db->bind(':product_name', $this->getName());
        $this->db->bind(':product_price', $this->getPrice());
        $this->db->bind(':product_type', $this->getType());

        // Bind the values specific to the Furniture class
        $this->db->bind(':size', $this->getSize());

        return $this->db->execute();
    }
}
