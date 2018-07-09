<?php

class User extends Database {

    /** variables */
    
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


    function checkPasswords($p1, $p2){
        if ($p1 == $p2 ) {
            return true; 
        } else {
            throw new Exception("The passwords are not matching, please try again.");
        }
    }

    function register($username, $education, $email, $pass){
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

    function hashPassword($password){
        $hash = password_hash($password, PASSWORD_BCRYPT); 
        //echo $hash; 
        return $hash;
    }

    function checkRegister($username, $mail){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE username = :username and email = :email"); 
            $query->bindParam(':username', $username);
            $query->bindParam(':email', $mail);
            $query->execute(); 

            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                if ($username == $result['username']){
                    throw new Exception("Username already exists, please choose another one.");
                } else if ($mail == $result['email']){
                    throw new Exception("Email already exists, please choose another one.");
                }
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
   
}

?>