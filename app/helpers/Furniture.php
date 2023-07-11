<?php

namespace App\Helpers;
use App\Helpers\Product;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;


    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getSize(): ?int
    {
        return null; 
    }


    public function save(): bool
    {

        $this->db->query("INSERT INTO " . $this->getTable() . " (product_sku, product_name, product_price, product_type, height, width, length) VALUES (:product_sku, :product_name, :product_price, :product_type, :height, :width, :length)");

        // Bind the values from the parent class
        $this->db->bind(':product_sku', $this->getSku());
        $this->db->bind(':product_name', $this->getName());
        $this->db->bind(':product_price', $this->getPrice());
        $this->db->bind(':product_type', $this->getType());

        // Bind the values specific to the Furniture class
        $this->db->bind(':height', $this->getHeight());
        $this->db->bind(':width', $this->getWidth());
        $this->db->bind(':length', $this->getLength());

        return $this->db->execute();
    }
}
