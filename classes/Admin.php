<?php

include_once("Database.php"); 

class Admin extends Database {

    /** setters */
    public function setAdmin(){
        $this->admin = 1; 
        return $this;
    }

    
    /** variables */
    private $username; 
    private $education;
    private $adminId; 

    /** getters */
    public function getUsername(){
        return $this->username;
    }

    public function getEducation(){
        return $this->education;
    }

    public function getAdminId(){
        return $this->adminId; 
    }

    /** setters */
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function setEducation($education){
        $this->education = $education;
        return $this;
    }

    public function setAdminId($id){
        $this->adminId = $id;
        return $this; 
    }
    
    /** functions */
    public function saveAdmin(){
        try {
            $query = $this->connection()->prepare('INSERT INTO `admin`(`username`, `education`) VALUES (:username, :education)');
            
            $query->bindParam(':username', $this->username);
            $query->bindParam(':education', $this->education);

            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }

    }

}

?>