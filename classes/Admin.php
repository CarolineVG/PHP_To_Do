<?php

class Admin extends Database {
    /** variables */
    private $adminId; 
    private $name; 
    private $pass;
    private $education;
    private $email; 

    /** getters */
    public function getAdminId(){
        return $this->adminId; 
    }

    public function getName(){
        return $this->name; 
    }

    public function getPass(){
        return $this->pass; 
    }

    public function getEducation(){
        return $this->education; 
    }

    public function getEmail(){
        return $this->email; 
    }

    /** setters */
    public function setAdminId($adminId){
        $this->adminId = $adminId;
        return $this; 
    }

    public function setName($name){
        $this->name = $name;
        return $this; 
    }

    public function setPass($pass){
        $this->pass = $pass;
        return $this; 
    }

    public function setEducation($education){
        $this->education = $education;
        return $this; 
    }

    public function setEmail($email){
        $this->email = $email;
        return $this; 
    }
}

?>