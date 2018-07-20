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

                echo '<li class="list-group-item"><a href="taskDetail.php?task=' . $result['id'] . '" data-id="'. $result['id'] . '">;<div class="media">
                    <img src="img/user.png" alt="user">
                    <div class="media-body">
                        <div class="media-text">
                            <h5>'. $result['title'] . '&nbsp;<span>' . $result['taskStatus'] . '</span> <span class="deadline">' . $result['deadline'] . '</h5>
                            <p>' . $r['username'] . '</p>
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

    public function addNewTask(){

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

    public function addNewTaskWithoutDeadline(){
        $title = $this->getTitle(); 
        $workhours = $this->getWorkhours();
        $startDate = $this->getStartDate(); 
        $status = $this->getTaskStatus(); 
        $projectId = $this->getProjectId();
        $user = $this->getUserId(); 
        echo $workhours; 
        
       try {
            $query = $this->connection()->prepare("INSERT INTO task(title, userId, projectId, startDate, taskStatus, workhours) VALUES (:title, :userid, :projectid, :startdate, :taskStatus, :workhours)"); 
            $query->bindParam(':title', $title);
            $query->bindParam(':userid', $user);
            $query->bindParam(':projectid', $projectId);
            $query->bindParam(':startdate', $startDate);
            $query->bindParam(':taskStatus', $status);
            $query->bindParam(':workhours', $workhours);
            $query->execute();

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showTaskFromId(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task WHERE id = :id"); 
            $query->bindParam(':id', $this->taskId);
            $query->execute(); 

        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $userid = $result['userId'];

            // show days to deadline 
            $endDate = $result['deadline'];
            $today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
            $today = date("Y-m-d");      
            $date1=date_create($today);
            $date2=date_create($endDate);
            
            $interval = date_diff($date1, $date2);
            if($interval->format('%r')){
                $output =  $interval->format('%a') . ' days too late'; 
            } else {
                $output =  $interval->format('%a') . ' days left'; 
            }

            echo '<div class="media">
            <img src="img/user.png" alt="user">
            <div class="media-body">
                <div class="media-text">
                    <h5>' . $result['title'] . '<span>' . $result["taskStatus"] . '</span>
                    <span class="deadline">' . $output . '</h5>
                    <p>' . $result["userId"] . '</p>
                </div>

                <div class="taskicons">
                    <a href="editTask.php?post=' . $result['id'] . '"><i class="fas fa-pencil-alt"></i></a>
                    <a href="deleteTask.php?post=' . $result['id'] . '"><i class="fas fa-trash-alt"></i></a>
                    <input class="checkbox" type="checkbox">
                </div>
            </div>
        </div>
        <hr>';
        }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showMyDeadlines(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task WHERE userId = :userid");             
            $query->bindParam(':userid', $this->userId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $projectid = $result['projectId'];

                // select projectid
                $q = $this->connection()->prepare("SELECT title FROM project WHERE id = :projectid"); 
                $q->bindParam(':projectid', $projectid);
                $q->execute(); 
                $r = $q->fetch(PDO::FETCH_ASSOC);
                
                echo '<li class="list-group-item">
                <div class="media">
                    <img src="img/user.png" alt="user">
                    <div class="mediabody">
                        <h5>'. $r['title'] . ' <span>' . $result['deadline'] . '</span>
                        </h5> 
                        <p>' . $result['title'] . '</p>
                    </div>
                </div>
            </li>';
                
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function filterMyDeadlines(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task WHERE userId = :userid AND projectId = :projectid");             
            $query->bindParam(':userid', $this->userId);
            $query->bindParam(':projectid', $this->projectId);

            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $projectid = $result['projectId'];

                // select projectid
                $q = $this->connection()->prepare("SELECT title FROM project WHERE id = :projectid"); 
                $q->bindParam(':projectid', $projectid);
                $q->execute(); 
                $r = $q->fetch(PDO::FETCH_ASSOC);
                
                echo '<li class="list-group-item">
                <div class="media">
                    <img src="img/user.png" alt="user">
                    <div class="mediabody">
                        <h5>'. $r['title'] . ' <span>' . $result['deadline'] . '</span>
                        </h5> 
                        <p>' . $result['title'] . '</p>
                    </div>
                </div>
            </li>';
                
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
    
    public function deleteTask(){
        try {
            $query = $this->connection()->prepare("DELETE FROM task WHERE id = :id"); 
            $query->bindParam(':id', $this->taskId);
            $query->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showEditTask(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task WHERE id = :id"); 
            $query->bindParam(':id', $this->taskId);
            $query->execute(); 

        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $projectId = $result['projectId'];
                            
            // select username from user where id = :userId
            $q = $this->connection()->prepare("SELECT title FROM project WHERE id = :projectid"); 
            $q->bindParam(':projectid', $projectId);
            $q->execute(); 
            $r = $q->fetch(PDO::FETCH_ASSOC); 


            // show current data in placeholders
            echo '
            <div class="form-group">
                Project
                <input class="form-control" disabled type="text" name="project" id="editTaskProject" value="'. $r['title'] . '">
            </div>
            <div class="form-group">
                Title
                <input class="form-control" type="text" name="taskname" id="taskname" value="'. $result['title'] . '">
            </div>
            <div class="form-group">
                Work hours
                <input class="form-control" type="text" name="workhours" id="workhours" value="'.$result['workhours'].'">
            </div>

            <div class="form-group">
                Start date
                <input class="form-control" type="text" name="startdate" id="startDate" value="'.$result['startDate'].'">
            </div>

            <div class="form-group">
                Deadline
                <input class="form-control" type="text" name="deadline" id="deadline" value="'.$result['deadline'].'">
            </div>

            <div class="form-group">
                Status
                <input class="form-control" type="text" name="taskStatus" id="taskStatus" value="'.$result['taskStatus'].'">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="submit">Edit Task</button>
            </div>';
        }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }

    }
    
    public function editTask(){
        $title = $this->getTitle(); 
        $workhours = $this->getWorkhours(); 
        $deadline = $this->getDeadline(); 
        $startDate = $this->getStartDate(); 
        $status = $this->getTaskStatus(); 
        $projectId = $this->getProjectId();
        $user = $this->getUserId(); 
        echo $workhours; 
        
       try {
            $query = $this->connection()->prepare("UPDATE task SET id=:id title=:title,userId=:userId, projectId=:projectid,startDate=:startdate,deadline=:deadline,taskStatus=:taskstatus,workhours=:workhours WHERE 1"); 
            $query->bindParam(':title', $title);
            $query->bindParam(':userid', $user);
            $query->bindParam(':projectid', $projectId);
            $query->bindParam(':startdate', $startDate);
            $query->bindParam(':deadline', $deadline);
            $query->bindParam(':taskstatus', $status);
            $query->bindParam(':workhours', $workhours);
            $query->execute();

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
}

?>