<?php
class Orders
{

    // database connection and table weight
    private $conn;
    private $orders = "orders";

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
    function create_orders(){}

}

?>