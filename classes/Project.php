<?php

class Project extends Database {
    /** variables */
    private $title;
    private $projectId; 
    private $adminId; 
    private $tasks;
    private $people; 

    /** getters */
    public function getTitle(){
        return $this->title; 
    }

    public function getAdminId(){
        return $this->adminId; 
    }

    public function getProjectId(){
        return $this->projectId; 
    }

    /** setters */
    public function setTitle($title){
        $this->title = $title; 
        return $this; 
    }

    public function setAdminId($adminId){
        $this->adminId = $adminId; 
        return $this; 
    }

    public function setProjectId($projectId){
        $this->projectId = $projectId; 
        return $this; 
    }
    
    /** functions */
    public function saveToDatabase(){
        echo "saving...";
        try {
            $query = $this->connection()->prepare("INSERT INTO project (title, adminId) VALUES (:title, :adminId);"); 
            $query->bindParam(':title', $this->getTitle());
            $query->bindParam(':adminId', $this->getAdminId());
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }


    public function showTasks(){
        // select * from tasks where project id = this projectid
    }

}

?>