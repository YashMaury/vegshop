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
    include_once '../../objects/vendor.php';
    $database = new Database();
    $db = $database->getConnection();
    $vendor_reg = new Vendor($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    //print_r($data);  
// make sure data is not empty
    if (
        !empty($data->name) &&
        !empty($data->email) &&
        !empty($data->password) &&
        !empty($data->phone) &&
        !empty($data->pincode)
    ) {

        // set values
        $vendor_reg->name = $data->name;
        $vendor_reg->email = $data->email;
        $vendor_reg->password = $data->password;
        $vendor_reg->phone = $data->phone;
        $vendor_reg->pincode = $data->pincode;
        $vendor_reg->created_at = $data->created_at;
        $vendor_reg->created_by = $data->created_by;


        // create the rankincome
        if ($vendor_reg->vendor_registration()) {

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Vendor registered successfully."));
        }

        // if unable to create the rankincome, tell the user
        else {

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to register vendor."));
            // $log_msg = "Unable to updated customer. Data is incomplete : " . basename($_SERVER['PHP_SELF']);
        }
    }

    // tell the user data is incomplete
    else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to register vendor. Data is incomplete."));
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