<?php
require_once 'DBConfig.php';

class DBConnect {

    public $connection; 

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USERNAME, PASSWORD);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
            exit;
        }

        return $this->connection;
    }

}
?>