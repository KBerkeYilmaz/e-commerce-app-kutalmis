<?php
// You might need to adjust these paths based on your project structure
require_once '../app/bootstrap.php';
require_once '../app/Models/Product.php';

use App\Models\Product;

// // Instantiate the Product model
// $productModel = new Product();

// // Get the products
// $products = $productModel->getProducts();

// // Check if there are any products
// if($products) {
//     // Output the products
//     echo "<pre>";
//     print_r($products);
//     echo "</pre>";
// } else {
//     echo "No products found.";
// }

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
  


$productModel = new Product();

$products = $productModel->getProducts();
$json = json_encode($products);

// Based on the result, send a success or error response
if ($json) {
    http_response_code(200);
    echo $json;
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to get products']);
}
