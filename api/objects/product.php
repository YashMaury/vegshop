<?php
class Product
{

    // database connection and table weight
    private $conn;
    private $product = "product";

    // object properties
    public $id;
    public $product_code;
    public $title;
    public $weight;
    public $quantity;
    public $regular_price;
    public $sale_price;
    public $description ;
    public $image;
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
    function create_product()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->product . "
                SET
                        product_code=:product_code,
                        title=:title,
                        weight=:weight,
                        quantity=:quantity,
                        regular_price=:regular_price,
                        sale_price=:sale_price,
                        description=:description,  
                        image=:image,
                        status=0,
                        created_at=:created_at,
                        created_by=:created_by";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_code = htmlspecialchars(strip_tags($this->product_code));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->regular_price = htmlspecialchars(strip_tags($this->regular_price));
        $this->sale_price = htmlspecialchars(strip_tags($this->sale_price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":product_code", $this->product_code);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":weight", $this->weight);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":regular_price", $this->regular_price);
        $stmt->bindParam(":sale_price", $this->sale_price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function update_product()
    {

        // query to insert record
        $query = "UPDATE
                " . $this->product . "
            SET
                    title=:title,
                    weight=:weight,
                    quantity=:quantity,
                    regular_price=:regular_price,
                    sale_price=:sale_price,
                    description=:description,  
                    image=:image,
                    updated_at=:updated_at,
                    updated_by=:updated_by
                    WHERE 
                    id=:id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->regular_price = htmlspecialchars(strip_tags($this->regular_price));
        $this->sale_price = htmlspecialchars(strip_tags($this->sale_price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->updated_by = htmlspecialchars(strip_tags($this->updated_by));

        //bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":weight", $this->weight);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":regular_price", $this->regular_price);
        $stmt->bindParam(":sale_price", $this->sale_price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
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