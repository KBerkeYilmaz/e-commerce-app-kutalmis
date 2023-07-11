<?php

namespace App\Pages;

use App\Handlers\DeleteRequestHandler;
use App\Libraries\Controller;
use App\Models\Product;

class Delete extends Controller
{
    public function add()
    {
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

        // Instantiate your model and handler
        $productModel = new Product();
        $deleteHandler = new DeleteRequestHandler($productModel);

        // Use the handler to process the request
        $result = $postHandler->handle($sanitizedData);

        // Based on the result, send a success or error response
        if ($result) {
            http_response_code(200);
            echo json_encode(['success' => 'Product added successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to add product']);
        }
    }

    private function validateInput($data)
    {
        // Simple validation: check that all required fields are present
        $requiredFields = ['product_sku', 'product_name', 'product_price', 'product_type_id'];
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
}
