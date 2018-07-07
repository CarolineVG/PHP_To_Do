<?php

class Database {

    private $conn; 
    private $host;
    private $user;
    private $password;
    private $databaseName;

    // connection
    public function connection(){   
        /*$this->host = "localhost"; 
        $this->user = "root";
        $this->password = "";
        $this->databaseName = "todo"; */

        try {
            //$conn = new PDO("'mysql:host=" . $this->host . "; dbname=" . $this->databaseName . "', " . $this->user . ", ". $this->password); 
            $conn = new PDO('mysql:host=localhost;dbname=todo', 'root', '');

            echo "connection ok";
            return $conn;
        } catch (PDOException $e) {
            print_r($e->getMessage); 
        }
    }
}
?>