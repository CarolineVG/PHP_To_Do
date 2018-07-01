<?php

class Database {
    // connection
    public function connection(){
        try {
            $conn = new PDO('mysql:host=localhost; dbname=test', 'root', ''); 
        } catch (PDOException $e){
            print_r($e->getMessage); 
        }
        echo "connection ok"; 
    }
}

?>