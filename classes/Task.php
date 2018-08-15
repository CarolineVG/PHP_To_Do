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
    private $document; 

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

    public function getDocument(){
        return $this->document; 
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

    public function setDocument($document){
        $this->document = $document; 
        return $this; 
    }

    /** functions */
    public function showTasksFromProject(){
            $query = $this->connection()->prepare("SELECT * FROM task WHERE projectId = :id"); 
            $query->bindParam(':id', $this->projectId);
            $query->execute(); 

            // check if there are tasks
            if($query->rowCount() == 0){
                // no tasks
                echo "This project doesn't have a task yet. "; 

            } else {
                // check status of task 
                // to do 
                // if not started -> class orange, else ... 
                // show tasks
                while ($result = $query->fetch(PDO::FETCH_ASSOC)) {

                    $userid = $result['userId'];

                    // current user
                    $currentUser = $this->getUserId(); 
                    if ($currentUser != $userid){
                        $checkbox = '<input class="checkbox" disabled type="checkbox" id="check" data-value="' . $result['id'] . '">';
                    } else {
                        $checkbox = '<input class="checkbox" type="checkbox" id="check" data-value="' . $result['id'] . '">';
                    }


    
                    // select username from user where id = :userId
                    $q = $this->connection()->prepare("SELECT username, picture FROM user WHERE id = :userid"); 
                    $q->bindParam(':userid', $userid);
                    $q->execute(); 
                    $r = $q->fetch(PDO::FETCH_ASSOC); 

                    // check deadline
                    if ($result['deadline'] == "0000-00-00"){
                        $deadline = 'No Deadline';
                    } else {
                        $deadline = $result['deadline'];
                    }

                    // check status
                    if ($result['taskStatus'] != "DONE") {
                        // TO DO
                        echo '<li class="list-group-item">
                                <a class="clickdetail" href="taskDetail.php?task=' . $result['id'] . '" data-id="'. $result['id'] . '">
                                <div class="media">
                                    <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
                                    <div class="media-body">
                                        <div class="media-text">
                                            <h5>'. $result['title'] . '
                                            <p class="status orange"  id="id' . $result['id'] . '">' . $result['taskStatus'] . '</p> 
                                            <p class="deadline">' . $deadline . '</h5>
                                        </div>
                                        <div class="media-input">
                                            <p>' . $r['username'] . '</p>
                                            '. $checkbox . '
                                        </div>
                                    </div>
                                </div>
                            <hr>
                        </li>';
                    } else {
                        // DONE
                        echo '<li class="list-group-item">
                                <a class="clickdetail" href="taskDetail.php?task=' . $result['id'] . '" data-id="'. $result['id'] . '">
                                <div class="media">
                                    <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
                                    <div class="media-body">
                                        <div class="media-text">
                                            <h5>'. $result['title'] . '
                                            <p class="status orange" id="' . $result['id'] . '">' . $result['taskStatus'] . '</p> 
                                            <p class="deadline">' . $deadline . '</h5>
                                        </div>
                                        <div class="media-input">
                                            <p>' . $r['username'] . '</p>
                                            '. $checkbox . '
                                        </div>
                                    </div>
                                </div>
                            <hr>
                        </li>';
                    }
                }
            }
    }

    public function taskIsDone(){
        $status = "DONE";

        $query = $this->connection()->prepare("UPDATE task SET taskStatus = :taskStatus WHERE id = :id AND userId = :user"); 
            $query->bindParam(':id', $this->taskId);
            $query->bindParam(':taskStatus', $status);
            $query->bindParam(':user', $this->userId); 
            $query->execute(); 
    }

    public function taskToDo(){
        $status = "TO DO";

        $query = $this->connection()->prepare("UPDATE task SET taskStatus = :taskStatus WHERE id = :id AND userId = :user"); 
            $query->bindParam(':id', $this->taskId);
            $query->bindParam(':taskStatus', $status);
            $query->bindParam(':user', $this->userId); 
            $query->execute(); 
    }

    public function checkWorkHours(){
        // check if number
        if (is_numeric($this->workhours)!=1) {
            throw new Exception("Please enter a number.");
        }

        // check if not too high
        if ($this->workhours > 300) {
            throw new Exception("You're never gonna work that long!");
        }
    }   

    public function checkDeadline(){

        // source: https://secure.php.net/manual/en/function.checkdate.php
        function validateDate($date, $format = 'Y-m-d'){
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        // check if correct date
        if (!validateDate($this->deadline)){
            throw new Exception("Please enter a date in the following format: Y-m-d (2018-12-05)");
        } 

        // check if not in the past
        $today = $this->startDate; 
        $deadline = $this->deadline; 

        if ($deadline < $today) {
            throw new Exception("Deadline is in the past!");
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

             // select username from user where id = :userId
             $q = $this->connection()->prepare("SELECT username, picture FROM user WHERE id = :userid"); 
             $q->bindParam(':userid', $userid);
             $q->execute(); 
             $r = $q->fetch(PDO::FETCH_ASSOC); 

            // check deadline
            if ($result['deadline'] == "0000-00-00"){
                // no deadline
                $output = "No Deadline"; 
            } else {
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
            }

            // check color of status 

        echo '<div class="task_wrapper" id="' . $result["id"] . '">
            <div class="task_img">
                <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
            </div>
            <div class="task_title">
                <h5>' . $result['title'] . '</h5>
            </div>
            <div class="task_status">
                <h5 class="orange">' . $result["taskStatus"] . '</h5>
            </div>
            <div class="task_deadline">
                <h5 class="deadline">' . $output . '</h5>
            </div>
            <div class="task_icons">
                <a href="editTask.php?post=' . $result['id'] . '"><i class="fas fa-pencil-alt"></i></a>
                <a href="deleteTask.php?post=' . $result['id'] . '"><i class="fas fa-trash-alt"></i></a>
                <input class="checkbox" type="checkbox">
            </div>
            <div class="task_user">
                <p>' . $r['username'] . '</p>
            </div>
            <div class="task_document">
                <i class="fas fa-paperclip"></i>
                <a href="' . $result['document'] . '"> ' . $result['document'] . '</a>
            </div>
        </div>
        <hr>
        <p>Comments:</p>';
        }

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showWeeklyDeadlines(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM task ORDER BY deadline");             
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $projectid = $result['projectId'];

                // select projectid
                $q = $this->connection()->prepare("SELECT title FROM project WHERE id = :projectid"); 
                $q->bindParam(':projectid', $projectid);
                $q->execute(); 
                $r = $q->fetch(PDO::FETCH_ASSOC);

                // select user picture 
                $z = $this->connection()->prepare("SELECT * FROM user WHERE id = :userid"); 
                $z->bindParam(':userid', $this->userId);
                $z->execute(); 
                $y = $z->fetch(PDO::FETCH_ASSOC);

                // check deadline
                if (!$result['deadline'] == "0000-00-00"){
                    // only show when deadline is within 7 days
                $endDate = $result['deadline'];
                $today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $today = date("Y-m-d");      
                $date1=date_create($today);
                $date2=date_create($endDate);
                
                $interval = date_diff($date1, $date2);

                // check if interval is + 
                if (!$interval->format('%r')){
                    // check if interval < 7
                    if($interval->format('%a') < 7){
                        // show days left
                        $output = $interval->format('%a') . ' days left'; 
                        
                        echo '<li class="list-group-item">
                        <div class="media">
                            <i class="fas fa-book"></i>
                            <div class="mediabody">
                                <h5>'. $r['title'] . ' <span>' . $result['workhours'] . ' hours</span>
                                </h5> <p>' . $result['deadline'] . ' ' . $output . '</p>
                                <p>' . $result['title'] . '</p>
                            </div>
                        </div>
                    </li>';
                    }
                }
                }

                
                
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

                // select user picture 
                $z = $this->connection()->prepare("SELECT * FROM user WHERE id = :userid"); 
                $z->bindParam(':userid', $this->userId);
                $z->execute(); 
                $y = $z->fetch(PDO::FETCH_ASSOC);

                // check deadline
                if ($result['deadline'] == "0000-00-00"){
                    $deadline = 'No Deadline';
                } else {
                    $deadline = $result['deadline'];
                }
                
                echo '<a class="clickdetail" href="taskDetail.php?task=' . $result['id'] . '" data-id="'. $result['id'] . '">        
                <li class="list-group-item">
                <div class="media" id="' . $projectid . '">
                    <img src="' . $y['picture'] . '" alt="'. $y['picture'] .'">
                    <div class="mediabody">
                        <h5>'. $r['title'] . ' <span>' . $deadline . '</span>
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

            if($query->rowCount() == 0){
                // no tasks
                return '<div class="media media-filter">
                There are no deadlines for you in this project!
                </div>';
                

            } else {
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $projectid = $result['projectId'];

                // select projectid
                $q = $this->connection()->prepare("SELECT title FROM project WHERE id = :projectid"); 
                $q->bindParam(':projectid', $projectid);
                $q->execute(); 
                $r = $q->fetch(PDO::FETCH_ASSOC);

                // select user picture 
                $z = $this->connection()->prepare("SELECT * FROM user WHERE id = :userid"); 
                $z->bindParam(':userid', $this->userId);
                $z->execute(); 
                $y = $z->fetch(PDO::FETCH_ASSOC);
                
                return '<div class="media media-filter">
                <img src="' . $y['picture'] . '" alt="'. $y['picture'] .'">
                    <div class="mediabody">
                        <h5>'. $r['title'] . ' <span>' . $result['deadline'] . '</span>
                        </h5> 
                        <p>' . $result['title'] . '</p>
                    </div>
                </div>';
                
            }}
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

    public function deleteTasksByProjectId(){
        try {
            $query = $this->connection()->prepare("DELETE FROM task WHERE projectId = :id"); 
            $query->bindParam(':id', $this->projectId);
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
                <input class="form-control" type="text" name="projectname" id="editTaskProject" value="'. $r['title'] . '">
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
        $id = $this->getTaskId(); 
        $title = $this->getTitle(); 
        $workhours = $this->getWorkhours(); 
        $deadline = $this->getDeadline(); 
        $startDate = $this->getStartDate(); 
        $status = $this->getTaskStatus(); 
        $projectId = $this->getProjectId();
        $user = $this->getUserId();
        
       try {
            $query = $this->connection()->prepare("UPDATE task SET title=:title,userId=:userid, projectId=:projectid,startDate=:startdate,deadline=:deadline,taskStatus=:taskstatus,workhours=:workhours WHERE id =:id"); 
            $query->bindParam(':id', $id); 
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

    public function uploadFile(){
        $id = $this->getTaskId();
        $document = $this->getDocument();  
        
       try {
            $query = $this->connection()->prepare("UPDATE task SET document=:document WHERE id =:id"); 
            $query->bindParam(':id', $id); 
            $query->bindParam(':document', $document); 
            $query->execute();

            
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }

            
    }

    public function checkIfTaskExists(){
        $query = $this->connection()->prepare("SELECT title FROM task WHERE projectId = :projectId"); 
        $query->bindParam(':projectId', $this->projectId); 
        $query->execute(); 

        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($this->title == $result['title']){
                throw new Exception("Task name already exists!");
            }
            
        }
    }
    
    public function getProjectIdByTaskId(){
        $query = $this->connection()->prepare("SELECT * FROM task WHERE id = :taskId"); 
        $query->bindParam(':taskId', $this->taskId); 
        $query->execute(); 

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['projectId'];            
        
    }
}

?>