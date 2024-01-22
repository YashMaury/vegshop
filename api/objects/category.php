<?php
class Category
{

    // database connection and table name
    private $conn;
    private $category = "category";

    // object properties
    public $id;
    public $name;
    public $slug;
    public $status;
    public $created_at;
    public $created_by;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // insert customer
    function create_category()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->category . "
                SET
                        name=:name,
                        slug=:slug,
                        status=0,
                        created_at=:created_at,
                        created_by=:created_by";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->slug = htmlspecialchars(strip_tags($this->slug));
        // $this->status = htmlspecialchars(strip_tags($this->status));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        //bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":slug", $this->slug);
        // $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":created_by", $this->created_by);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function delete_category()
    {
        // delete query
        $query = "DELETE FROM " . $this->category . " WHERE id = :id";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind id of record to delete
        $stmt->bindParam(":id", $this->id);
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}

?>