<?php

class User extends Database {

    /** variables */
    private $database; 

    function show() {
        $query = $this->connection()->query("SELECT * FROM user"); 

        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            echo $result['firstname'];
        }

    }
     

    function login() {

    }

    function checklogin(){
    }
   
}

?>