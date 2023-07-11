<?php 
// You might need to adjust these paths based on your project structure
use App\Models\Product;
require_once '../app/bootstrap.php';


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
