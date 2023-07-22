<?php

namespace App\Helpers;

use App\Libraries\Database;
abstract class ProductAbstract
{

    protected $db;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    protected $validProperties = [
        'sku',
        'name',
        'price',
    ];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTable(): string
    {
        return 'products_main';
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function skuExists($sku)
    {
        $this->db->query("SELECT * FROM " . $this->getTable() . " WHERE product_sku = :sku");
        $this->db->bind(':sku', $sku);

        $results = $this->db->resultSet();

        return !empty($results);
    }


    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    abstract public function save(): bool;

    public function populate(array $data): void
    {
        foreach ($data as $key => $value) {
            // Remove 'product_' and 'furniture_' prefixes from the key
            $key = str_replace(['product_', 'furniture_'], '', $key);

            // Check if this property is valid for the current product type
            if (!in_array($key, $this->validProperties)) {
                continue;
            }

            // Convert the array key to StudlyCase to match the setter method name
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }
    }
}
