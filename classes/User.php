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
        echo "logging in"; 
    }

    function checklogin($user, $pass){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE username = :username and pass = :pass"); 
            $query->bindParam(':username', $user);
            $query->bindParam(':pass', $pass);
            $query->execute(); 

            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                // if query gives result 
                if (isset($result['username'])) {
                    echo $result['username'];
                    return true; 
                } else {
                    echo "nope"; 
                    return false; 
                }

            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
   
}

?>