<?php

class Task extends Database {
    /** variables */
    private $taskId;
    private $title;
    private $userId;
    private $projectId;
    private $startDate;
    private $endDate;
    private $status; 

    /** getters */
    public function getTaskId(){
        return $this->taskId;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getProjectId(){
        return $this->projectId;
    }

    public function getStartDate(){
        return $this->startDate;
    }

    public function getEndDate(){
        return $this->endDate;
    }

    public function getStatus(){
        return $this->status;
    }
    
    /** setters  */
    public function setTaskId($taskId){
        $this->taskId = $taskId;
        return $this;
    }
    
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    public function setUserId($userId){
        $this->userId = $userId;
        return $this;
    }

    public function setProjectId($projectId){
        $this->projectId = $projectId;
        return $this;
    }
    
    public function setStartDate($startDate){
        $this->startDate = $startDate;
        return $this;
    }

    public function setEndDate($endDate){
        $this->endDate = $endDate;
        return $this;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    /** functions */
    public function showTasksFromProject(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task WHERE projectId = :id"); 
            $query->bindParam(':id', $this->projectId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<li class="list-group-item">
                <div class="media">
                    <img src="img/user.png" alt="user">
                    <div class="media-body">
                        <div class="media-text">
                            <h5>'. $result['title'] . '&nbsp;<span>' . $result['status'] . '</span></h5>
                            <p>' . $result['userId'] . '</p>
                        </div>
                        <input class="checkbox" type="checkbox">
                    </div>
                    </div>
                    <hr>
                </li>';
            }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

}

?>