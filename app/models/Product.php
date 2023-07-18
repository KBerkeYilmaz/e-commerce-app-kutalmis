<?php

namespace App\Models;

use App\Libraries\Database;
use App\Helpers\ProductInterface;

class Product
{
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTable(): string
    {
        return 'products_main';
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

        return $this->db->execute();
    }

    public function deleteAll()
    {
        $this->db->query("TRUNCATE TABLE " . $this->getTable());

        return $this->db->execute();
    }
}
