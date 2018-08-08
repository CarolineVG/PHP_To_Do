<?php


class Database {

    // connection
    public function connection(){  
        require("./settings.php"); 

        try {
            $conn = new PDO("mysql:host=".$settings['host']."; dbname=".$settings['databaseName'] . ";", $settings['username'], $settings['password']);
            //echo "connection ok"; 
            return $conn;
        } catch (PDOException $e) {
            print_r($e->getMessage); 
            //echo "not ok"; 
        }
    }
}
?>