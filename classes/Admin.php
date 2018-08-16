<?php

include_once("Database.php"); 

class Admin extends Database {

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

    public function showAllAdmins(){

        $query = $this->connection()->prepare('SELECT * FROM `admin`');
        $query->execute(); 

        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $username = $result['username'];
            // user picture
            $q = $this->connection()->prepare("SELECT * FROM user WHERE username = :username"); 
            $q->bindParam(':username', $username);
            $q->execute(); 

            while ($r = $q->fetch(PDO::FETCH_ASSOC)){
                if ($result['username'] == $this->getUsername()){
                    // cant delete your own
                    echo ' <div class="media">
                            <img src="' . $r['picture'] . '">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>' . $result['username'] . '</h5>
                                    <a class="disabled" disabled href="deleteAdmin.php?admin=' . $result['id'] . '">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <hr>';
                } else {
                    echo ' <div class="media">
                            <img src="' . $r['picture'] . '">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>' . $result['username'] . '</h5>
                                    <a href="deleteAdmin.php?admin=' . $result['id'] . '">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <hr>';
                }


                
            }
        }



    }

    public function deleteAdmin(){
        // get admin id
        $id = $this->getAdminId(); 

        echo $id; 

        $query = $this->connection()->prepare('DELETE FROM `admin` WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute(); 
    }

}

?>