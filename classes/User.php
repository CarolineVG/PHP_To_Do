<?php

class User extends Database {

    /** variables */
    private $username;
    private $mail; 
    private $education;
    private $password;
    private $password2;
    private $hash; 
    private $userId; 
    private $image; 
    private $admin; 
    private $adminId; 

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

    public function getHash(){
        return $this->hash; 
    }

    public function getUserId(){
        $query = $this->connection()->prepare("SELECT id FROM user WHERE username = :username"); 
        $query->bindParam(':username', $this->username);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    public function getImage(){
        return $this->image; 
    }

    public function getAdmin(){
        echo $this->admin; 
        return 'admin: ' . $this->admin; 
    }

    public function getAdminId(){
        echo $this->adminId; 
        return $this->adminId; 
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

    public function setHash($hash){
        $this->hash = $hash;
        return $this; 
    }

    public function setUserId($id){
        $this->userId = $id;
        return $this; 
    }

    public function setImage($image){
        $this->image = $image;
        return $this; 
    }

    public function setAdmin($admin){
        $this->admin = $admin;
        return $this; 
    }
    
    public function setAdminId($adminId){
        $this->adminId = $adminId;
        return $this; 
    }

    /** functions */
    function login() {
        // start session
        session_start(); 
        // save username
        $_SESSION['username'] = $this->username; 
    }

    function checkAdmin(){
        $query = $this->connection()->prepare("SELECT * FROM user WHERE username = :username"); 
        $query->bindParam(':username', $this->username);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
            
        if ($result['isAdmin'] == 1) {
            return true; 
        }
    }

    function checklogin(){
        $query = $this->connection()->prepare("SELECT * FROM user WHERE email = :email"); 
        $query->bindParam(':email', $this->mail);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
            
        // check email
        if ($result['email'] != $this->mail) {
            throw new Exception("Email unknown, please try again.");            
        } else {
            // check password 
            if (password_verify($this->password, $result['pass'])){
                //echo "password ok"; 
            } else {
                //echo "not ok"; 
                throw new Exception("Password is wrong, please try again.");
            }
        }
    }

    function findUsername(){
        $query = $this->connection()->prepare("SELECT username FROM user WHERE email = :email"); 
        $query->bindParam(':email', $this->mail);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        //echo $result['username']; 
        return $result['username']; 

    }

    function checkPasswords(){
        if ($this->password == $this->password2 ) {
            return true; 
        } else {
            throw new Exception("The passwords are not matching, please try again.");
        }
    }

    function strongPassword(){
        if (strlen($this->password) >= 8) {
            return true; 
        } else {
            throw new Exception("Your password has to be longer than 8 characters.");
        }
    }

    function register(){
            //echo "register"; 
            $query = $this->connection()->prepare("INSERT INTO user(username, education, email, pass, picture, isAdmin, adminId) VALUES (:username, :education, :email, :pass, :picture, :isAdmin, :adminId)");
            $query->bindParam(':username', $this->username);
            $query->bindParam(':education', $this->education);
            $query->bindParam(':email', $this->mail);
            $query->bindParam(':pass', $this->hash);
            $query->bindParam(':picture', $this->image);
            $query->bindParam(':isAdmin', $this->admin); 
            $query->bindParam(':adminId', $this->adminId); 

            $query->execute(); 
    }

    function hashPassword(){
        $this->hash = password_hash($this->password, PASSWORD_DEFAULT); 
        //echo $hash; 
        return $this->hash;
    }

    function checkRegister(){
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
    }

    function getUserIdByName($username){
        $query = $this->connection()->prepare("SELECT id FROM user WHERE username = :username"); 
        $query->bindParam(':username', $username);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC); 
        return $result['id']; 
    }

    function uploadUserPicture(){
        $query = $this->connection()->prepare("UPDATE user SET picture=:picture WHERE id =:userid"); 
        $query->bindParam(':userid', $this->userId); 
        $query->bindParam(':picture', $this->image);
        $query->execute();

    }

    function showUserImage(){
        $query = $this->connection()->prepare("SELECT picture FROM user WHERE id = :id"); 
        $query->bindParam(':id', $this->userId);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return '<img src="'. $result['picture'] . '" alt="'. $result['picture'] . '">';

    }
    
    function showEducation(){
        $query = $this->connection()->prepare("SELECT * FROM user WHERE id = :id"); 
        $query->bindParam(':id', $this->userId);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return ($result['isAdmin'] ? 'Admin ' : 'Student ') . $result['education'];

    }

    function showUser(){
        $query = $this->connection()->prepare("SELECT * FROM user WHERE id = :id"); 
        $query->bindParam(':id', $this->userId);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        echo $result['username'];
    }
}

?>