<?php

class Database {
    // connection
    public function connection(){
        try {
            $conn = new PDO('mysql:host=localhost; dbname=todo', 'root', ''); 
        } catch (PDOException $e){
            print_r($e->getMessage); 
        }
        echo "connection ok"; 

        return $conn; 

        // check if user exists 

        /*$username = "Caroline"; 
        $query = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $query->bindParam(":username", $username); 
        $res = $query->execute();
        while ($res = $query->fetch(PDO::FETCH_ASSOC)){
            print_r($res); 
        }*/
    }

    // select query
    public function select($name, $value){
        $query = $conn->prepare("SELECT * FROM user WHERE :name = :value");
        $query->bindParam(":name", $name); 
        $query->bindParam(":value", $value); 
        $result = $query->execute();

        // show in array
        while ($res = $query->fetch(PDO::FETCH_ASSOC)){
            print_r($res); 
        }
    }
}

?>