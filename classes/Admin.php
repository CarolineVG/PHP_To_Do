<?php

include_once("User.php"); 
include_once("Database.php"); 

class Admin extends Database {

    /** setters */
    public function setAdmin(){
        $this->admin = 1; 
        return $this;
    }

}

?>