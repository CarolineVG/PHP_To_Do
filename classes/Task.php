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
    private $workhours; 

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

    public function getDeadline(){
        return $this->deadline;
    }

    public function getTaskStatus(){
        return $this->status;
    }

    public function getWorkhours(){
        return $this->workhours;
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

    public function setDeadline($deadline){
        $this->deadline = $deadline;
        return $this;
    }

    public function setTaskStatus($status){
        $this->status = $status;
        return $this;
    }

    public function setWorkhours($workhours){
        $this->workhours = $workhours;
        return $this;
    }

    /** functions */
    public function showTasksFromProject(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task WHERE projectId = :id"); 
            $query->bindParam(':id', $this->projectId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {

                $userid = $result['userId'];

                // select username from user where id = :userId
                $q = $this->connection()->prepare("SELECT username FROM user WHERE id = :userid"); 
                $q->bindParam(':userid', $userid);
                $q->execute(); 
                $r = $q->fetch(PDO::FETCH_ASSOC); 

                echo '<li class="list-group-item">
                <div class="media">
                    <img src="img/user.png" alt="user">
                    <div class="media-body">
                        <div class="media-text">
                            <h5>'. $result['title'] . '&nbsp;<span>' . $result['taskStatus'] . '</span></h5>
                            <p>' . $r['username'] . '</p>
                        </div>
                        <input class="checkbox" type="checkbox">
                    </div>
                    </div>
                    <hr>
                    <!-- hidden -->
                    <div class="comment-hidden">
                        <div class="media">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>Caroline Van Gossum</h5>
                                    <p class="comment">This is my reaction</p>
                                </div>
                            </div>                    
                            <img src="img/user.png" alt="user">
                        </div>
                        
                        <hr>
                        <form id="mycomment" action="">
                            <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
                            <input type="submit" value="Add Comment">
                        </form>
                    </div>
                </li>';
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function addNewTask(){

        $dbdate = date("Y-m-d");

        $title = $this->getTitle(); 
        $workhours = $this->getWorkhours(); 
        $deadline = $this->getDeadline(); 
        $startDate = $this->getStartDate(); 
        $status = $this->getTaskStatus(); 
        $projectId = $this->getProjectId();
        $user = $this->getUserId(); 
        echo $workhours; 
        
       try {
            $query = $this->connection()->prepare("INSERT INTO task(title, userId, projectId, startDate, deadline, taskStatus, workhours) VALUES (:title, :userid, :projectid, :startdate, :deadline, :taskStatus, :workhours)"); 
            $query->bindParam(':title', $title);
            $query->bindParam(':userid', $user);
            $query->bindParam(':projectid', $projectId);
            $query->bindParam(':startdate', $startDate);
            $query->bindParam(':deadline', $deadline);
            $query->bindParam(':taskStatus', $status);
            $query->bindParam(':workhours', $workhours);
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
}

?>