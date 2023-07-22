<?php

namespace App\Helpers;

interface ProductInterface
{
    public function getAll();
    public function delete($data);
    public function deleteAll();
}
