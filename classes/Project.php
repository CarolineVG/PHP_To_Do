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
        $title = $this->getTitle();
        $adminId = $this->getAdminId(); 
        try {
            $query = $this->connection()->prepare("INSERT INTO project (title, adminId) VALUES (:title, :adminId);"); 
            $query->bindParam(':title', $title);
            $query->bindParam(':adminId', $adminId);
            $query->execute(); 
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showProjects($id){
        try {
            $query = $this->connection()->prepare("SELECT * FROM project WHERE adminId = :adminId"); 
            $query->bindParam(':adminId', $id);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card"><div class="card-header" role="tab"><h5 class="mb-0"><i class="fas fa-book"></i><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1">' . $result['title'] . '</a></h5></div></div>'; 
            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
    
    public function showTasks(){
        // select * from tasks where project id = this projectid
    }

}

?>