<?php
class Review
{

    // database connection and table product_id
    private $conn;
    private $review = "review";

    // object properties
    public $id;
    public $customer_id;
    public $customer_name;
    public $product_id;
    public $rating;
    public $comment;
    public $status;
    public $created_at;
    public $created_by;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // insert customer
    function add_review()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->review . "
                SET
                        customer_id=:customer_id,
                        customer_name=:customer_name,
                        product_id=:product_id,
                        rating=:rating,
                        comment=:comment,
                        status=0,
                        created_at=:created_at,
                        created_by=:created_by";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":customer_id", $this->customer_id);
        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":comment", $this->comment);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

}

?>