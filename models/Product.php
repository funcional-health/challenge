<?php
    class Product{
        private $conn;
        private $table = "product";

        //Properties
        public $id;
        public $name;
        public $industry;
        public $price;
        public $amount;

        //Constructor
        public function __construct($db){
            $this->conn = $db;
        }

        //List products
        public function list(){
            $query = 'SELECT * 
                FROM ' . $this->table;

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        //Search with params
        public function search(){
            $query = 'SELECT * 
                FROM ' . $this->table . '
                WHERE 1';

            if($this->name != NULL){
                $query .= " AND name = '".$this->name."'";
            }
            if($this->industry != NULL){
                 $query .= " AND industry = '".$this->industry."'";
            }
            if($this->price != NULL){
                $query .= " AND price = '".$this->price."'";
            }
            if($this->amount != NULL){
                $query .= " AND amount = '". $this->amount."'";
            }

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;

        }

        //Create product
        public function create(){
            $query = 'INSERT INTO ' . $this->table . '
                SET 
                    name = :name,
                    industry = :industry,
                    price = :price,
                    amount = :amount';

            $stmt = $this->conn->prepare($query);

            //Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':industry', $this->industry);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':amount', $this->amount);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;

        }

        //Update product
        public function update(){
            $query = 'UPDATE ' . $this->table . '
                SET 
                    name = :name,
                    industry = :industry,
                    price = :price,
                    amount = :amount
                WHERE
                    id = :id';

            $stmt = $this->conn->prepare($query);

            //Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':industry', $this->industry);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':amount', $this->amount);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;

        }

        //Delete product
        public function delete(){
            $query = 'DELETE FROM '.$this->table.' 
                WHERE 
                    id = :id';

            $stmt = $this->conn->prepare($query);

            //Bind data
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
?>