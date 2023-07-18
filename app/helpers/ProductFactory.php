<?php

namespace App\Helpers;

class ProductFactory
{
    public static function createProduct(string $type)
    {
        $className = '\\App\\Models\\' . ucfirst(strtolower($type));

        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Unknown product type');
        }

        return new $className();
    }
}
