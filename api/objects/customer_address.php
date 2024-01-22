<?php
class Customer_address
{

    // database connection and table name
    private $conn;
    private $customer_address = "customer_address";

    // object properties
    public $id;
    public $customer_id;
    public $address;
    public $landmark;
    public $city;
    public $pincode;
    public $status;
    public $created_at;
    public $created_by;
    public $updated_at;
    public $updated_by;
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // insert customer
    function add_address()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->customer_address . "
                SET
                        customer_id=:customer_id,
                        address=:address,
                        landmark=:landmark,
                        city=:city,
                        pincode=:pincode,
                        status=0,
                        created_at=:created_at,
                        created_by=:created_by";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->landmark = htmlspecialchars(strip_tags($this->landmark));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->pincode = htmlspecialchars(strip_tags($this->pincode));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":customer_id", $this->customer_id);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":landmark", $this->landmark);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":pincode", $this->pincode);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function update_address()
    {

        // query to insert record
        $query = "UPDATE
                " . $this->customer_address . "
            SET
                    address=:address,
                    landmark=:landmark,
                    city=:city,
                    pincode=:pincode,
                    updated_at=:updated_at,
                    updated_by=:updated_by
                    WHERE 
                    customer_id=:customer_id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->landmark = htmlspecialchars(strip_tags($this->landmark));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->pincode = htmlspecialchars(strip_tags($this->pincode));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->updated_by = htmlspecialchars(strip_tags($this->updated_by));

        //bind values
        $stmt->bindParam(":customer_id", $this->customer_id);

        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":landmark", $this->landmark);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":pincode", $this->pincode);
        $stmt->bindParam(":updated_at", $this->updated_at);
        $stmt->bindParam(":updated_by", $this->updated_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

}

?>