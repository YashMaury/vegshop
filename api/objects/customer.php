<?php
class Customer
{

    // database connection and table name
    private $conn;
    private $customer = "customer";

    // object properties

    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
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
    function customer_registration()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->customer . "
                SET
                        name=:name,
                        email=:email,
                        password=:password,
                        phone=:phone, 
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
        // $this->status = htmlspecialchars(strip_tags($this->status));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        // $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
    // Withdraw Request //

    function update_password()
    {

        // query to insert record
        $query = "UPDATE
                " . $this->customer . "
            SET
                    password=:password,
                    updated_at=:updated_at,
                    updated_by=:updated_by
                    WHERE 
                    id=:id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->updated_by = htmlspecialchars(strip_tags($this->updated_by));

        //bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":updated_at", $this->updated_at);
        $stmt->bindParam(":updated_by", $this->updated_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function notice_read()
    {
        // select all query
        $query = "SELECT notice_title, content, id, status  FROM " . $this->notice;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        return $stmt;
    }

    function updateClosingAmount()
    {

        // query to insert record
        $query = "UPDATE
                " . $this->customer_purchase . "
            SET
                    plot_paid_amount=:plot_paid_amount,  left_amount=:left_amount WHERE c_id=:c_id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->plot_paid_amount = htmlspecialchars(strip_tags($this->plot_paid_amount));
        $this->left_amount = htmlspecialchars(strip_tags($this->left_amount));

        //bind values
        $stmt->bindParam(":plot_paid_amount", $this->plot_paid_amount);
        $stmt->bindParam(":left_amount", $this->left_amount);
        $stmt->bindParam(":c_id", $this->c_id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }


}

?>