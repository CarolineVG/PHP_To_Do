<?php

/** INCLUDES */
include_once("./settings.php"); 

class Database {

    private $conn; 
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $databaseName = 'todo';

    // connection
    public function connection(){   
                
        $settings = [
            "host" => "localhost",
            "username" => "root",
            "password" => "",
            "databaseName" => "todo",
        ];

        try {

            $conn = new PDO("mysql:host=".$settings['host'].";dbname=".$settings['databaseName'], $settings['username'], $settings['password']);

            //echo "connection ok";
            return $conn;
        } catch (PDOException $e) {
            print_r($e->getMessage); 
        }
    }
}
?>