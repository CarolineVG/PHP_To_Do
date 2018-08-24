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
        
            $query = $this->connection()->prepare("INSERT INTO project(title, creator)VALUES(:title, :creator)"); 
            $query->bindParam(':title', $title);
            $query->bindParam(':creator', $creator);
            $query->execute(); 
    }

    public function getProjectIdFromDatabase(){
        $title = $this->getTitle(); 

        // save to table projectUser
            $query = $this->connection()->prepare("SELECT * FROM project WHERE title = :title"); 
            $query->bindParam(':title', $title);
            $query->execute(); 

            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
    }

    public function saveToProjectUser(){
        $projectId = $this->getProjectId();
        $creator = $this->getCreator(); 

        // save to table projectUser
            $query = $this->connection()->prepare("INSERT INTO projectuser (projectId, userId) VALUES(:projectId, :userId);"); 
            $query->bindParam(':projectId', $projectId);
            $query->bindParam(':userId', $creator);
            $query->execute(); 
            //echo "ok"; 
    }

    public function showProjects(){
            $query = $this->connection()->prepare("SELECT * FROM project WHERE creator = :creator"); 
            $query->bindParam(':creator', $this->userId);
            $query->execute(); 

            // show message if no projects yet
            if($query->rowCount() == 0){
                echo '<p class="empty">There are no projects yet.</p>'; 
            } else {
                while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="card-project">
                    <i class="fas fa-book"></i>
                    <a href="index.php?project=' . $result['id'] . '" data-id="'. $result['id'] . '"><h5>' . $result['title'] . '</h5></a>
                    <a href="deleteProject.php?project=' . $result['id'] . '"><i class="fas fa-trash-alt"></i></a></div>';
                }
            } 
    }

    public function showJoinedProjects(){
            // select distinct -> show value only once
            $query = $this->connection()->prepare("SELECT DISTINCT(projectId) FROM projectuser WHERE userId = :userId"); 
            $query->bindParam(':userId', $this->userId);
            $query->execute(); 

             // show message if no projects yet
             if($query->rowCount() == 0){
                echo '<p class="empty">You haven\'t joined a project yet.</p>'; 
            } else {
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
                            <a class="disabled" href="deleteProject.php?project=' . $r['id'] . '"><i class="fas fa-trash-alt"></i></a></div>';
                        }
                    } 
                }
            }
    }

    public function showProjectsInDropdown(){
            $query = $this->connection()->prepare("SELECT DISTINCT(projectId) FROM projectuser WHERE userId = :userId"); 
            $query->bindParam(':userId', $this->userId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $id = $result['projectId'];
                // project id to project name 
                $q = $this->connection()->prepare("SELECT * FROM project WHERE id = :id"); 
                $q->bindParam(':id', $id);
                $q->execute(); 

                while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
                    // project id in value
                    echo '<option value=' . $r['id'] . '>' . $r['title'] . '</option>';
                }
            }
    }

    public function showAllProjectsInDropdown(){
            $query = $this->connection()->prepare("SELECT * FROM project");
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                // only show projects with different creator 
                if ($result['creator'] != $this->userId){ 
                    echo '<option value=' . $result['id'] . '>' . $result['title'] . '</option>';
                }
            }
    }

    public function deleteProject(){
        // delete in table project
            $query = $this->connection()->prepare("DELETE FROM project WHERE id = :id"); 
            $query->bindParam(':id', $this->projectId);
            $query->execute();

        // delete in table projectUser
            $query = $this->connection()->prepare("DELETE FROM projectuser WHERE projectId = :projectId"); 
            $query->bindParam(':projectId', $this->projectId);
            $query->execute();
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
        
            $query = $this->connection()->prepare("INSERT INTO projectuser (projectId, userId)VALUES(:projectId, :userId)"); 
            $query->bindParam(':projectId', $project);
            $query->bindParam(':userId', $user);
            $query->execute(); 
    }
}

?>