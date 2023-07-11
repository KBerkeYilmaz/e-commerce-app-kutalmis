<?php

namespace App\Pages;

use App\Libraries\Controller;
use App\Models\Product;
use Exception;

class Get extends Controller
{
    public function get()
    {
        try {
            // Instantiate your model
            $productModel = new Product();
            
            echo 'Attempting to get products...'; // Debugging line
            $products = $productModel->getProducts();
            echo 'Products fetched: '; // Debugging line
            var_dump($products); // Debugging line
            $json = json_encode($products);
            
            // Based on the result, send a success or error response
            if ($json) {
                http_response_code(200);
                echo $json;
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to get products']);
            }
            
        } catch (Exception $e) {
            echo 'An error occurred: '; // Debugging line
            var_dump($e->getMessage()); // Debugging line
            error_log('An error occurred: ' . $e->getMessage());
            return http_response_code();
        }
    }
}


// namespace App\Pages;

// use App\Handlers\GetRequestHandler;
// use App\Libraries\Controller;

// class Get extends Controller
// {
//     public function get()
//     {
//         echo 'get() method called'; // Add this debugging line

//         // Instantiate your model and handler
//         $productModel = $this->model('Product');
//         $getRequestHandler = new GetRequestHandler($productModel);

//         // Use the handler to process the request
//         $result = $getRequestHandler->handle();

//         echo $result;

//         // Based on the result, send a success or error response
//         if ($result) {
//             $data = [
//                 'title' => 'Get Results',
//                 'result' => $result
//             ];
//             $this->view('get', $data);
//         } else {
//             http_response_code(500);
//             echo json_encode(['error' => 'Failed to get products']);
//         }
//     }
// }


