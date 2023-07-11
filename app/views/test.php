<?php

namespace App\Pages;

use App\Handlers\GetRequestHandler;
use App\Libraries\Controller;
use App\Models\Product;

class Get extends Controller
{
    public function get()
    {
        echo 'get() method called'; // Add this debugging line

        // Instantiate your model and handler
        $productModel = new Product();
        $getRequestHandler = new GetRequestHandler($productModel);

        // Use the handler to process the request
        $result = $getRequestHandler->handle();


        echo '$result';

        // Based on the result, send a success or error response
        if ($result) {
            http_response_code(200);
            echo $result;
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to get products']);
        }
    }
}
