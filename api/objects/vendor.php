<?php
class Vendor
{

    // database connection and table name
    private $conn;
    private $vendor = "vendor";

    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $landmark;
    public $city;
    public $pincode;
    public $account_name;
    public $account_no;
    public $branch;
    public $ifsc;
    public $upi;
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
    function vendor_registration()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->vendor . "
                SET
                        name=:name,
                        email=:email,
                        password=:password,
                        phone=:phone,
                        pincode=:pincode,
                        status=0,
                        created_at=:created_at,
                        created_by=:created_by";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->pincode = htmlspecialchars(strip_tags($this->pincode));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":pincode", $this->pincode);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function update_profile()
    {

        // query to insert record
        $query = "UPDATE
                " . $this->vendor . "
            SET
                    name=:name,
                    address=:address,
                    landmark=:landmark,
                    city=:city,
                    account_name=:account_name,
                    account_no=:account_no,
                    branch=:branch,
                    ifsc=:ifsc,
                    upi=:upi,
                    updated_at=:updated_at,
                    updated_by=:updated_by
                    WHERE 
                    id=:id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->landmark = htmlspecialchars(strip_tags($this->landmark));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->account_name = htmlspecialchars(strip_tags($this->account_name));
        $this->account_no = htmlspecialchars(strip_tags($this->account_no));
        $this->branch = htmlspecialchars(strip_tags($this->branch));
        $this->ifsc = htmlspecialchars(strip_tags($this->ifsc));
        $this->upi = htmlspecialchars(strip_tags($this->upi));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->updated_by = htmlspecialchars(strip_tags($this->updated_by));

        //bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":landmark", $this->landmark);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":account_name", $this->account_name);
        $stmt->bindParam(":account_no", $this->account_no);
        $stmt->bindParam(":branch", $this->branch);
        $stmt->bindParam(":ifsc", $this->ifsc);
        $stmt->bindParam(":upi", $this->upi);
        $stmt->bindParam(":updated_at", $this->updated_at);
        $stmt->bindParam(":updated_by", $this->updated_by);
        $stmt->bindParam(":id", $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

}

?>