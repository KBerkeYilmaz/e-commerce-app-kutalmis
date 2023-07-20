<?php

namespace App\Models;

use App\Helpers\ProductAbstract;
use App\Models\Product;

class Furniture extends ProductAbstract
{   
    protected $type = 'furniture';
    protected $height;
    protected $width;
    protected $length;

    protected $validProperties = [
        'sku',
        'name',
        'price',
        'height',
        'width',
        'length',
    ];


    public function getType(): string
    {
        return $this->type;
    }

    // public function setType(int $type): void
    // {
    //     $this->type = $type;
    // }
    
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


    public function save(): bool
    {

        $this->db->query("INSERT INTO " . $this->getTable() . " (product_sku, product_name, product_price, product_type, furniture_height, furniture_width, furniture_length) VALUES (:product_sku, :product_name, :product_price, :product_type, :furniture_height, :furniture_width, :furniture_length)");

        // Bind the values from the parent class
        $this->db->bind(':product_sku', $this->getSku());
        $this->db->bind(':product_name', $this->getName());
        $this->db->bind(':product_price', $this->getPrice());
        $this->db->bind(':product_type', $this->getType());

        // Bind the values specific to the Furniture class
        $this->db->bind(':furniture_height', $this->getHeight());
        $this->db->bind(':furniture_width', $this->getWidth());
        $this->db->bind(':furniture_length', $this->getLength());

        return $this->db->execute();
    }
}
