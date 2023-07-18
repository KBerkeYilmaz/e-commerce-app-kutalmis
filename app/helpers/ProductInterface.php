<?php

namespace App\Helpers; 

interface ProductInterface 
{   
    // public function getType(): string;
    // public function getSku(): string;
    // public function setSku(string $sku): void;
    // public function getName(): string;
    // public function setName(string $name): void;
    // public function getPrice(): float;
    // public function setPrice(float $price): void;
    public function getAll();
    public function delete($data);
    public function deleteAll();
    // public function save(): bool;
}