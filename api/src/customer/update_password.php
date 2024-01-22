<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
try {
    include_once '../../config/database.php';
    include_once '../../objects/customer.php';
    $database = new Database();
    $db = $database->getConnection();

    $customer = new Customer($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    $customer->id = $data->id;
    //print_r($data);  
    // make sure data is not empty
    if (
        !empty($data->password)
    ) {

        // set values
        $customer->password = $data->password;
        $customer->updated_at = $data->updated_at;
        $customer->updated_by = $data->updated_by;

        // create the rankincome
        if ($customer->update_password()) {
            // echo "fes";

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Password updated successfully."));
        }

        // if unable to create the rankincome, tell the user
        else {

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to update password."));
        }
    }

    // tell the user data is incomplete
    else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to update password. Data is incomplete."));
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