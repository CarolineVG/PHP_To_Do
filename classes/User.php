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

    function checklogin($user, $pass){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE username = :username and pass = :pass"); 
            $query->bindParam(':username', $user);
            $query->bindParam(':pass', $pass);
            $query->execute(); 

            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                echo $result['username'] . ' ' . $result['pass'];

                // if user is found -> return false if null 
                if (!isset($result['username'])) {
                    echo "empty"; 
                }
            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
   
}

?>