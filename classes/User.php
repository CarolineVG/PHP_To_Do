<?php

class User {

    /** variables */
    private $database; 

    public function __construct($database) {
        $this->database = $database; 
    }
     

    function login() {

    }

    function checklogin(){
         // check if user exists 
        $query = $database->prepare("SELECT * FROM user WHERE username = :username");
        $query->bindParam(":username", $this->$username); 
        $res = $query->execute();
        while ($res = $query->fetch(PDO::FETCH_ASSOC)){
            print_r($res); 
        }

    }
   
}

?>