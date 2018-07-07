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

    function checklogin($user){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE username = :username"); 
            $query->bindParam(':username', $user);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                echo $result['username'];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
   
}

?>