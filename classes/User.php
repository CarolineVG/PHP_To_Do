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

    function checklogin($input_mail, $input_password){
        try {
            $query = $this->connection()->prepare("SELECT * FROM user WHERE email = :email and pass = :pass"); 
            $query->bindParam(':email', $input_mail);
            $query->bindParam(':pass', $input_password);
            $query->execute(); 

            $result = $query->fetch(PDO::FETCH_ASSOC);
            // check email
            if ($result['email'] == $input_mail) {
                throw new Exception("The passwords are not matching, please try again.");
                // check password -> hash!
                
            } 

            if (password_verify($input_password, $result['password'])){
                echo "password ok"; 
            } else {
                echo "not ok"; 
            }
            
            /*else if ($result['password'] == $this->pass){
                throw new Exception("The passwords are not matching, please try again.");
            }*/
            
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    function checkPasswords(){
        if ($this->password == $this->password2 ) {
            return true; 
        } else {
            throw new Exception("The passwords are not matching, please try again.");
        }
    }

    function register($pass){
        try {
            echo "register"; 
            $query = $this->connection()->prepare("INSERT INTO user(username, education, email, pass) VALUES (:username, :education, :email, :pass)");
            $query->bindParam(':username', $this->username);
            $query->bindParam(':education', $this->education);
            $query->bindParam(':email', $this->mail);
            $query->bindParam(':pass', $pass);
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    function hashPassword(){
        $hash = password_hash($this->password, PASSWORD_DEFAULT); 
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