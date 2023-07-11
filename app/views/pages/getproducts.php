<?php
// You might need to adjust these paths based on your project structure
require_once '../app/bootstrap.php';
require_once '../app/Models/Product.php';

// Instantiate the Product model
$productModel = new \App\Models\Product();

// Get the products
$products = $productModel->getProducts();

// Output the products
echo "<pre>";
print_r($products);
echo "</pre>";
