<?php
class Customer_billing
{

    // database connection and table name
    private $conn;
    private $customer_billing = "customer_billing";

    // object properties
    public $id;
    public $customer_id;
    public $card_type;
    public $name;
    public $card_no;
    public $cvv;
    public $exp_month;
    public $exp_year;
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
    function add_billing()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->customer_billing . "
                SET
                        customer_id=:customer_id,
                        card_type=:card_type,
                        name=:name,
                        card_no=:card_no,
                        cvv=:cvv,
                        exp_month=:exp_month,
                        exp_year=:exp_year,
                        status=0,
                        created_at=:created_at,
                        created_by=:created_by";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->card_type = htmlspecialchars(strip_tags($this->card_type));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->card_no = htmlspecialchars(strip_tags($this->card_no));
        $this->cvv = htmlspecialchars(strip_tags($this->cvv));
        $this->exp_month = htmlspecialchars(strip_tags($this->exp_month));
        $this->exp_year = htmlspecialchars(strip_tags($this->exp_year));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":customer_id", $this->customer_id);
        $stmt->bindParam(":card_type", $this->card_type);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":card_no", $this->card_no);
        $stmt->bindParam(":cvv", $this->cvv);
        $stmt->bindParam(":exp_month", $this->exp_month);
        $stmt->bindParam(":exp_year", $this->exp_year);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function update_billing()
    {

        // query to insert record
        $query = "UPDATE
                " . $this->customer_billing . "
            SET
                    card_type=:card_type,
                    name=:name,
                    card_no=:card_no,
                    cvv=:cvv,
                    exp_month=:exp_month,
                    exp_year=:exp_year,
                    updated_at=:updated_at,
                    updated_by=:updated_by
                    WHERE 
                    customer_id=:customer_id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->card_type = htmlspecialchars(strip_tags($this->card_type));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->card_no = htmlspecialchars(strip_tags($this->card_no));
        $this->cvv = htmlspecialchars(strip_tags($this->cvv));
        $this->exp_month = htmlspecialchars(strip_tags($this->exp_month));
        $this->exp_year = htmlspecialchars(strip_tags($this->exp_year));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->updated_by = htmlspecialchars(strip_tags($this->updated_by));

        //bind values
        $stmt->bindParam(":customer_id", $this->customer_id);

        $stmt->bindParam(":card_type", $this->card_type);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":card_no", $this->card_no);
        $stmt->bindParam(":cvv", $this->cvv);
        $stmt->bindParam(":exp_month", $this->exp_month);
        $stmt->bindParam(":exp_year", $this->exp_year);
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