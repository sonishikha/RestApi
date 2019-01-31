<?php
/**
 * Description of Products
 * Model class of products to perform CRUD operations
 */

require_once DB;

class Products extends DBConnect{

    // DB Connection instance
    private $conn;

    // table name
    private $table = "products";

    // table columns
    public $id;
    public $name;
    public $sku;
    public $description;
    public $price;
    public $quantity;
    public $created_at; 
    
    /**
    * Get DB coneection instance 
    */

    public function __construct(){
        $this->conn = $this->getConnection();
    }

    /**
    * Get current table
    */
    public function getTable(){
        return $this->table;
    }

    /**
    * To insert record
    */
    public function create(){
    
        $query = "INSERT INTO  $this->table SET 
            name = :name,
            sku = :sku,
            description = :description,
            price = :price,
            quantity = :quantity,
            created_at= :created_at";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':created_at', $this->created_at);

        return $stmt;
    }

    /**
    * To read all the data
    */
    public function read(){
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    /**
    * To read single record
    * @var string $column
    * @var string $value
    */
    public function readRow($column, $value){
        $query = "SELECT * FROM $this->table WHERE $column = :$column LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":$column", $value);

        $stmt->execute();
        
        return $stmt;
    }

    /**
    * To update record
    * @var string columns
    * @var string $where
    */
    public function update($columns, $where){
        $query = "UPDATE $this->table SET 
            $columns
            WHERE $where";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind data
        if(isset($this->id) && !empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        if(isset($this->name) && !empty($this->name)){
            $stmt->bindParam(':name', $this->name);
        }
        if(isset($this->sku) && !empty($this->sku)){
            $stmt->bindParam(':sku', $this->sku);
        }
        if(isset($this->description) && !empty($this->description)){
            $stmt->bindParam(':description', $this->description);
        }
        if(isset($this->price) && !empty($this->price)){
            $stmt->bindParam(':price', $this->price);
        }
        if(isset($this->quantity) && !empty($this->quantity)){
            $stmt->bindParam(':quantity', $this->quantity);
        }
        
        return $stmt;    
    }

    /**
    * To delete record
    */
    public function delete(){
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt;
    }

    /**
    * Get table columns
    */
    public function getColumns(){
        $query = "SELECT * FROM information_schema.columns WHERE table_schema = '".DATABASE."' AND table_name = '$this->table'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}