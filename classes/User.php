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

    function checklogin($mail, $pass){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE email = :email and pass = :pass"); 
            $query->bindParam(':email', $mail);
            $query->bindParam(':pass', $pass);
            $query->execute(); 

            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                // if query gives result 
                if (isset($result['email'])) {
                    //echo $result['username'];
                    return true; 
                } else {
                    return false; 
                }
            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }


    function checkPasswords(){

    }

    function checkRegister($username, $education, $email, $pass){
        try {
            $query = $this->connection()->prepare("INSERT INTO user(username, education, pass, email) VALUES (:username, :education, :pass, :email )");
            $query->bindParam(':username', $username);
            $query->bindParam(':education', $education);
            $query->bindParam(':email', $email);
            $query->bindParam(':pass', $pass);
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    function register(){

    }
   
}

?>