<?php

class User extends Database {

    /** variables */
    private $username;
    private $mail; 
    private $education;
    private $password;
    private $password2;

    /** getters */
    public function getUsername(){
        return $this->username;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getEducation(){
        return $this->education;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getPassword2(){
        return $this->password2;
    }

    /** setters */
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function setMail($mail){
        $this->mail = $mail;
        return $this;
    }

    public function setEducation($education){
        $this->education = $education;
        return $this;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function setPassword2($password2){
        $this->password2 = $password2;
        return $this;
    }
    
    function login() {
        echo "logging in"; 
    }

    function checklogin(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE email = :email and pass = :pass"); 
            $query->bindParam(':email', $mail);
            $query->bindParam(':pass', $password);
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
        if ($password == $password2 ) {
            return true; 
        } else {
            throw new Exception("The passwords are not matching, please try again.");
        }
    }

    function register($pass){
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

    function hashPassword(){
        $hash = password_hash($password, PASSWORD_BCRYPT); 
        //echo $hash; 
        return $hash;
    }

    function checkRegister(){
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