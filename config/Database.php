<?php

class Database{
    private $host = 'localhost';
    private $db_name = 'desafiotecnico';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect (){
        $this->conn = null;

        try{
            $this->conn = new PDO(
                'mysql:host=' . $this->host. ';db_name=' . $this->db_name, 
                $this->username, 
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            $this->conn->query("use desafiotecnico");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){

            echo 'Connection Error: '. $e->getMessage();
        }

        return $this->conn;
    }
}
?>