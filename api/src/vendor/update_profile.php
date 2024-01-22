<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
try {
    include_once '../../config/database.php';
    include_once '../../objects/vendor.php';
    $database = new Database();
    $db = $database->getConnection();

    $vendor = new Vendor($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    $vendor->id = $data->id;
    //print_r($data);  
    // make sure data is not empty
    if (
        !empty($data->name) &&
        !empty($data->address) &&
        !empty($data->landmark) &&
        !empty($data->city) &&
        !empty($data->account_name) &&
        !empty($data->account_no) &&
        !empty($data->branch) &&
        !empty($data->ifsc) &&
        !empty($data->upi)
    ) {

        // set admin_login values
        $vendor->name = $data->name;
        $vendor->address = $data->address;
        $vendor->landmark = $data->landmark;
        $vendor->city = $data->city;
        $vendor->account_name = $data->account_name;
        $vendor->account_no = $data->account_no;
        $vendor->branch = $data->branch;
        $vendor->ifsc = $data->ifsc;
        $vendor->upi = $data->upi;
        $vendor->updated_at = $data->updated_at;
        $vendor->updated_by = $data->updated_by;

        // create the rankincome
        if ($vendor->update_profile()) {

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Vendor profile updated."));
        }

        // if unable to create the rankincome, tell the user
        else {

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to update vendor profile."));
        }
    }

    // tell the user data is incomplete
    else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to update vendor profile. Data is incomplete."));
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