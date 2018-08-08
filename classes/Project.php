<?php

class Project extends Database {
    /** variables */
    private $title;
    private $projectId; 
    private $creator; 
    private $tasks;
    private $people; 
    private $userId; 

    /** getters */
    public function getTitle(){
        return $this->title; 
    }

    public function getCreator(){
        return $this->creator; 
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

    public function setCreator($creator){
        $this->creator = $creator; 
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
        $creator = $this->getCreator(); 
        try {
            $query = $this->connection()->prepare("INSERT INTO project(title, creator)VALUES(:title, :creator)"); 
            $query->bindParam(':title', $title);
            $query->bindParam(':creator', $creator);
            $query->execute(); 
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function saveToProjectUser(){
        $projectId = $this->getProjectId();
        $creator = $this->getCreator(); 

        // save to table projectUser
        try {
            $query = $this->connection()->prepare("INSERT INTO projectUser(projectId, userId)VALUES(:projectId, :userId)"); 
            $query->bindParam(':projectId', $projectId);
            $query->bindParam(':userId', $creator);
            $query->execute(); 
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showProjects(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM project WHERE creator = :creator"); 
            $query->bindParam(':creator', $this->userId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card-project">
                <i class="fas fa-book"></i>
                <a href="index.php?project=' . $result['id'] . '" data-id="'. $result['id'] . '"><h5>' . $result['title'] . '</h5></a>
                <a href="deleteProject.php?project=' . $result['id'] . '"><i class="fas fa-trash-alt"></i></a></div>';
            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showJoinedProjects(){
        try {
            // select distinct -> show value only once
            $query = $this->connection()->prepare("SELECT DISTINCT(projectId) FROM projectUser WHERE userId = :userId"); 
            $query->bindParam(':userId', $this->userId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $id = $result['projectId'];
                // project id to project name 
                $q = $this->connection()->prepare("SELECT * FROM project WHERE id = :id"); 
                $q->bindParam(':id', $id);
                $q->execute(); 
                while ($r = $q->fetch(PDO::FETCH_ASSOC)){
                    // only show projects with different admin id 
                    if ($r['creator'] != $this->userId){
                        echo '<div class="card-project">
                        <i class="fas fa-book"></i>
                        <a href="index.php?project=' . $r['id'] . '" data-id="'. $r['id'] . '"><h5>' . $r['title'] . '</h5></a>
                        <a href="deleteProject.php?project=' . $r['id'] . '"><i class="fas fa-trash-alt"></i></a></div>';
                    }
                } 
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showProjectsInDropdown(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM projectUser WHERE userId = :userId"); 
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

    public function showAllProjectsInDropdown(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM project");
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value=' . $result['id'] . '>' . $result['title'] . '</option>';
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
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

    public function joinProject(){
        $project = $this->getProjectId();
        $user = $this->getUserId(); 
        try {
            $query = $this->connection()->prepare("INSERT INTO projectUser (projectId, userId)VALUES(:projectId, :userId)"); 
            $query->bindParam(':projectId', $project);
            $query->bindParam(':userId', $user);
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
}

?>