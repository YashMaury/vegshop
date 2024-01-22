<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
try {
    include_once '../../config/database.php';
    include_once '../../objects/product.php';
    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    $product->id = $data->id;
    //print_r($data);  
    // make sure data is not empty
    if (
        !empty($data->title) &&
        !empty($data->weight) &&
        !empty($data->quantity) &&
        !empty($data->regular_price) &&
        !empty($data->sale_price) &&
        !empty($data->description)  
    ) {

        // set values
        $product->title = $data->title;
        $product->weight = $data->weight;
        $product->quantity = $data->quantity;
        $product->regular_price = $data->regular_price;
        $product->sale_price = $data->sale_price;
        $product->description = $data->description;  
        $product->image = $data->image;
        $product->updated_at = $data->updated_at;
        $product->updated_by = $data->updated_by;

        // create the rankincome
        if ($product->update_product()) {

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Product details updated successfully."));
        }

        // if unable to create the rankincome, tell the user
        else {

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to update product details."));
        }
    }

    // tell the user data is incomplete
    else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to update product details. Data is incomplete."));
    }
} catch (Exception $e) {

    if ($e->getMessage() == "Expired token") {

        //echo "#################################";

        // set response code
        http_response_code(401);

        // show error message
        echo json_encode(
            array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            )
        );



        //echo "*********************************************hello";
        //    header('Location: ' . $e->getMessage());

    } else {

        die();
    }
}

?>