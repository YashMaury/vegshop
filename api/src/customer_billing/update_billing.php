<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
try {
    include_once '../../config/database.php';
    include_once '../../objects/customer_billing.php';
    $database = new Database();
    $db = $database->getConnection();

    $customer_billing = new Customer_billing($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    $customer_billing->customer_id = $data->customer_id;
    //print_r($data);  
    // make sure data is not empty
    if (
        !empty($data->card_type) &&
        !empty($data->name) &&
        !empty($data->card_no) &&
        !empty($data->cvv) &&
        !empty($data->exp_month) &&
        !empty($data->exp_year)
    ) {

        // set values
        $customer_billing->card_type = $data->card_type;
        $customer_billing->name = $data->name;
        $customer_billing->card_no = $data->card_no;
        $customer_billing->cvv = $data->cvv;
        $customer_billing->exp_month = $data->exp_month;
        $customer_billing->exp_year = $data->exp_year;
        $customer_billing->updated_at = $data->updated_at;
        $customer_billing->updated_by = $data->updated_by;

        // create the rankincome
        if ($customer_billing->update_billing()) {

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Billing details updated successfully."));
        }

        // if unable to create the rankincome, tell the user
        else {

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to update billing details."));
        }
    }

    // tell the user data is incomplete
    else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to update billing details. Data is incomplete."));
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