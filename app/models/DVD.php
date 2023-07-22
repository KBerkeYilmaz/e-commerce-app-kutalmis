<?php

namespace App\Models;

use App\Helpers\ProductAbstract;

class Dvd extends ProductAbstract
{
    protected $type = 'dvd';
    protected $size;

    protected $validProperties = [
        'sku',
        'name',
        'price',
        'size',
    ];

    public function getTable(): string
    {
        return 'products_main';
    }

    public function getType(): string
    {
        return $this->type;
    }

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
        $this->db->query("INSERT INTO " . $this->getTable() . " (product_sku, product_name, product_price, product_type, dvd_size) VALUES (:product_sku, :product_name, :product_price, :product_type, :dvd_size)");

        // Bind the values from the parent class
        $this->db->bind(':product_sku', $this->getSku());
        $this->db->bind(':product_name', $this->getName());
        $this->db->bind(':product_price', $this->getPrice());
        $this->db->bind(':product_type', $this->getType());

        // Bind the values specific to the Furniture class
        $this->db->bind(':dvd_size', $this->getSize());

        return $this->db->execute();
    }
}
