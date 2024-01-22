<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
try {
    // get customer registration
    include_once '../../config/database.php';
    // instantiate customer registration
    include_once '../../objects/review.php';
    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    //print_r($data);  
// make sure data is not empty
    if (
        !empty($data->customer_id) &&
        !empty($data->customer_name) &&
        !empty($data->product_id) &&
        !empty($data->rating) &&
        !empty($data->comment)
    ) {

        // set values
        $review->customer_id = $data->customer_id;
        $review->customer_name = $data->customer_name;
        $review->product_id = $data->product_id;
        $review->rating = $data->rating;
        $review->comment = $data->comment;
        $review->created_at = $data->created_at;
        $review->created_by = $data->created_by;


        // create the rankincome
        if ($review->add_review()) {

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Review added successfully."));
        }

        // if unable to create the rankincome, tell the user
        else {

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to add review."));
            // $log_msg = "Unable to updated customer. Data is incomplete : " . basename($_SERVER['PHP_SELF']);
        }
    }

    // tell the user data is incomplete
    else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to add review. Data is incomplete."));
        // $log_msg = "Unable to updated customer. Data is incomplete : " . basename($_SERVER['PHP_SELF']);
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