<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/json');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

// namespace App\Pages;

// use App\Handlers\PostRequestHandler;
// use App\Libraries\Controller;
// use App\Models\Product;

// class Add extends Controller
// {
//     public function add()
//     {
//         // Assuming you're sending a JSON-encoded POST request
//         $data = json_decode(file_get_contents('php://input'), true);

        
//         if (!$this->validateInput($data)) {
//             // If the input is not valid, send an error response
//             http_response_code(400);
//             echo json_encode(['error' => 'Invalid input']);
//             exit;
//         }

//         // Sanitize the input
//         $sanitizedData = $this->sanitizeInput($data);

//         // Instantiate your model and handler
//         $productModel = new Product();
//         $postHandler = new PostRequestHandler($productModel);

//         // Use the handler to process the request
//         $result = $postHandler->handle($sanitizedData);

//         // Based on the result, send a success or error response
//         if ($result) {
//             http_response_code(200);
//             echo json_encode(['success' => 'Product added successfully']);
//         } else {
//             http_response_code(500);
//             echo json_encode(['error' => 'Failed to add product']);
//         }
//     }

//     private function validateInput($data)
//     {   
//         // Simple validation: check that all required fields are present
//         $requiredFields = ['product_sku', 'product_name', 'product_price', 'product_typ'];
//         foreach ($requiredFields as $field) {
//             if (!isset($data[$field]) || empty($data[$field])) {
//                 return false;
//             }
//         }
//         return true;
//     }

//     private function sanitizeInput($data)
//     {
//         $sanitizedData = [];
//         foreach ($data as $key => $value) {
//             $sanitizedData[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
//         }
//         return $sanitizedData;
//     }
// }
