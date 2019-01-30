<?php

/**
 * Description of ProductsController
 * Intermidiatry to fetch data from model, return data or response and handles error on failure or data not found.
 */
require_once MODEL.'Products.php';

class ProductsController extends Products{
    
    /*
     * Call parent contructor
     */
    function __contruct(){
        parent::__contruct();
    }

    /*
     * Get all products data
     */
    public function getAll(){
        $stmt = $this->read();
        $num = $stmt->rowCount();
        if($num>0){
            $products_arr=array();
            $products_arr["records"]=array();       
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $product_item=array(
                    "id" => $id,
                    "name" => $name,
                    "sku" => $sku,
                    "description" => html_entity_decode($description),
                    "price" => $price,
                    "quantity" => $quantity
                );
         
                array_push($products_arr["records"], $product_item);
            }
            return $products_arr;
        }
        return false;
    } 


    /*
     * Get product data by product id
     * @var int $productId
     */
    public function getById($productId){
        $stmt = $this->readRow('id', (int)$productId);
        $num = $stmt->rowCount();
        if($num>0){
            $products_arr=array();
            $products_arr["records"]=array();       
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $product_item=array(
                    "id" => $id,
                    "name" => $name,
                    "sku" => $sku,
                    "description" => html_entity_decode($description),
                    "price" => $price,
                    "quantity" => $quantity
                );
         
                array_push($products_arr["records"], $product_item);
            }
            return $products_arr;
        }
        return false;
    }

    /*
     * Create product record in database
     * @var array $data
     */
    public function createRecord($data){
        $this->name = $data['name'];
        $this->sku = $data['sku'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->quantity = $data['quantity'];
        $this->created = date('Y-m-d H:i:s');

        $stmt = $this->create();
        // Execute query
        if($stmt->execute()){
            return true;    
        }else{
            throw new Exception('MySQL Error '.$stmt->errorCode().': '.$stmt->errorInfo()[2], ERROR_CODE['BAD_REQUEST']);
        }
    }

    /*
     * Update product record by product id with data provided
     * @var int $productId
     * @var array $data
     */
    public function updateById($productId, $data){
        $this->id = (int)$productId;
        $columns = $where = "";
        $where .= 'id = :id';
        if(isset($data['name']) && !empty($data['name'])){
            $this->name = $data['name'];
            $columns .= 'name = :name,';
        }
        if(isset($data['sku']) && !empty($data['sku'])){
            $this->sku = $data['sku'];
            $columns .= 'sku = :sku,';
        }
        if(isset($data['description']) && !empty($data['description'])){
            $this->description = $data['description'];
            $columns .= 'description = :description,';
        }
        if(isset($data['price']) && !empty($data['price'])){
            $this->price = $data['price'];
            $columns .= 'price = :price,';
        }
        if(isset($data['quantity']) && !empty($data['quantity'])){
            $this->quantity = $data['quantity'];
            $columns .= 'quantity = :quantity,';
        }
        $columns = rtrim($columns, ",");
        
        $stmt = $this->update($columns, $where);
        
        // Execute query
        if($stmt->execute()){
            return true;    
        }else{
            throw new Exception('MySQL Error '.$stmt->errorCode().': '.$stmt->errorInfo()[2], ERROR_CODE['BAD_REQUEST']);
        }
    }

    /*
     * Delete product record by product id
     * @var int $productId
     */
    public function deleteById($productId){
        $this->id = $productId;
        $stmt = $this->delete();

        // Execute query
        if($stmt->execute()) {
            return true;
        }else{
            throw new Exception('MySQL Error '.$stmt->errorCode().': '.$stmt->errorInfo()[2], ERROR_CODE['BAD_REQUEST']);
        }
    }

    /*
     * Get alll the columns of product table
     * @var string $table
     */
    public function getTableColumns($table){
        if(strtolower($this->getTable()) == strtolower($table)){
            $stmt = $this->getColumns();
            $num = $stmt->rowCount();
            if($num>0){
                $columns = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($columns, $row);
                }
                return $columns;
            }else{
                throw new Exception('MySQL Error '.$stmt->errorCode().': '.$stmt->errorInfo()[2], ERROR_CODE['BAD_REQUEST']);
            }
        }else{
            throw new Exception('Cannot find table.', ERROR_CODE['BAD_REQUEST']);
        }
    }
}
