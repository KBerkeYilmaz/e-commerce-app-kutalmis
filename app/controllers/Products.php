<?php

namespace App\Controllers;

use App\Libraries\Controller;

class Products extends Controller
{

  private $productModel;


  public function __construct()
  {
    $this->productModel = $this->model('Product');
  }

  private function validateInput($data)
  {
    // Simple validation: check that all required fields are present
    $requiredFields = ['product_sku', 'product_name', 'product_price', 'product_type'];
    foreach ($requiredFields as $field) {
      if (!isset($data[$field]) || empty($data[$field])) {
        return false;
      }
    }
    return true;
  }

  private function sanitizeInput($data)
  {
    $sanitizedData = [];
    foreach ($data as $key => $value) {
      $sanitizedData[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    return $sanitizedData;
  }

  public function error404()
  {
    // Display an error page
    echo '404 error: Page not found.';
  }

  // GET REQUEST

  public function exhibit()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      // Handle preflight request
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Content-Type: text/plain, application/json');
      header('Content-Length: 0');
      http_response_code(200);
      exit;
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // Getting products
      $products = $this->productModel->getAll();

      // Based on the result, send a success or error response
      if ($products) {
        http_response_code(200);
        echo json_encode(['success' => 'Products retrieved successfully', 'products' => $products]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to retrieve products. Error code: 500']);
      }
    }
  }


  //// POST REQUEST 

  public function new()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      // Handle preflight request
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Content-Type: text/plain, application/json');
      header('Content-Length: 0');
      http_response_code(200);
      exit;
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Assuming you're sending a JSON-encoded POST request
      $data = json_decode(file_get_contents('php://input'), true);

      if (!$this->validateInput($data)) {
        // If the input is not valid, send an error response
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit;
      }

      // Sanitize the input
      $sanitizedData = $this->sanitizeInput($data);

      $productType = ucfirst($sanitizedData['product_type']);

      $productModel = $this->model($productType);

      // Check if the SKU exists, if not use the populate method to set the properties of the product

      $sku = $sanitizedData['product_sku'];
      if ($productModel->skuExists($sku)) {
        http_response_code(400);
        echo json_encode(['error' => 'SKU already exists']);
        exit;
      } else {

        $productModel->populate($sanitizedData);
      }

      // Save the product
      $result = $productModel->save();

      // Based on the result, send a success or error response
      if ($result) {
        http_response_code(200);
        echo json_encode(['success' => 'Product added successfully']);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to add product']);
      }
    }
  }

  // DELETE REQUEST
  public function delete($sku = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      // Handle preflight request
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: DELETE');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Content-Type: text/plain, application/json');
      header('Content-Length: 0');
      http_response_code(200);
      exit;
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
      if (empty($sku)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit;
      }

      $result = $this->productModel->delete($sku);

      if ($result) {
        http_response_code(200);
        echo json_encode(['success' => 'Product deleted successfully']);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete product']);
      }
    }
  }

  public function deleteAll()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      // Handle preflight request
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: DELETE');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Content-Type: text/plain, application/json');
      header('Content-Length: 0');
      http_response_code(200);
      exit;
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

      $result = $this->productModel->deleteAll();

      if ($result) {
        http_response_code(200);
        echo json_encode(['success' => 'All products deleted successfully']);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete products']);
      }
    }
  }
}
