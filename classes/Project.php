<?php

class Project extends Database {
    /** variables */
    private $title;
    private $projectId; 
    private $adminId; 
    private $tasks;
    private $people; 
    private $userId; 

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
    
    public function getUserId(){
        return $this->userId; 
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

    public function setUserId($userId){
        $this->userId = $userId; 
        return $this; 
    }
    
    /** functions */
    public function saveToDatabase(){
        $title = $this->getTitle();
        $adminId = $this->getAdminId(); 
        try {
            $query = $this->connection()->prepare("INSERT INTO project(title, adminId)VALUES(:title, :adminId)"); 
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
                echo '<div class="card"><div class="card-header" role="tab"><h5 class="mb-0"><i class="fas fa-book"></i><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-' . $result['id'] . '" href="div#item-' . $result['id'] . '">' . $result['title'] . '<a href="deleteProject.php?post=' . $result['id'] . '"><i class="fas 
                fa-trash-alt"></i></a></h5></a></h5></div>
                <div class="collapse" id="item-' . $result['id'] . '"><div class="card-body"><ul class="list-group">
                <li class="list-item">
                <a href="index.php?project=' . $result['id'] . '" data-id="'. $result['id'] . '">All Tasks</a>
                
                </li><li class="list-item">
                <a href="">People</a></li><li class="list-item"><a href="">Files</a></li>
                <li class="list-item"><a href="">Statistics</a></li></ul></div></div></div>'; 
            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showProjectsInDropdown(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM project_user WHERE userId = :userId"); 
            $query->bindParam(':userId', $this->userId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $id = $result['projectId'];
                // project id to project name 
                $q = $this->connection()->prepare("SELECT * FROM project WHERE id = :id"); 
                $q->bindParam(':id', $id);
                $q->execute(); 
                $r = $q->fetch(PDO::FETCH_ASSOC); 
                // project id in value
                echo '<option value=' . $r['id'] . '>' . $r['title'] . '</option>';
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
    
    public function showTasks(){
        // select * from tasks where project id = this projectid
    }

    public function deleteProject(){
        try {
            $query = $this->connection()->prepare("DELETE FROM project WHERE id = :id"); 
            $query->bindParam(':id', $this->projectId);
            $query->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function getProjectIdByName(){
        $query = $this->connection()->prepare("SELECT id FROM project WHERE title = :title"); 
        $query->bindParam(':title', $this->title);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
}

?>