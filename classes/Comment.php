<?php

class Comment extends Database {

    /** variables */
    private $reaction;
    private $taskId; 
    private $userId;
    private $id; 

    /** getters */
    public function getReaction(){
        return $this->reaction;
    }

    public function getTaskId(){
        return $this->taskId;
    }
    
    public function getUserId(){
        return $this->userId; 
    }

    public function getProjectId(){
        return $this->projectId;
    }

    public function getId(){
        return $this->id;
    }

    /** setters */
    public function setReaction($reaction){
        $this->reaction = $reaction;
        return $this;
    }

    public function setTaskId($taskId){
        $this->taskId = $taskId;
        return $this;
    }

    public function setUserId($id){
        $this->userId = $id;
        return $this; 
    }

    public function setProjectId($projectId){
        $this->projectId = $projectId;
        return $this; 
    }

    public function setId($id){
        $this->id = $id;
        return $this; 
    }

    /** functions */
    public function getIdFromDb(){
        $query = $this->connection()->prepare("SELECT * FROM comment WHERE reaction = :reaction AND userId = :userid"); 
        $query->bindParam(':reaction', $this->reaction);
        $query->bindParam(':userid', $this->userId);$query->execute(); 
            
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        return $result['id'];
    }

    public function showCommentsFromTask(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM comment WHERE taskId = :id"); 
            $query->bindParam(':id', $this->taskId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                // get user
                $user = $result['userId'];

                // userid to name 
                $q = $this->connection()->prepare("SELECT * FROM user WHERE id = :userid"); 
                $q->bindParam(':userid', $user);
                $q->execute(); 

                while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="media">
                        <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
                        <div class="media-body">
                            <h5>'.$r['username'].'</h5>
                            <p class="comment">' . $result['reaction'] . '</p>
                        </div>
                    </div>';
                }
            
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function showNewComment(){
        // select last record 
            $query = $this->connection()->prepare("SELECT * FROM comment WHERE id = :id"); 
            $query->bindParam(':id', $this->id);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                // get user
                $user = $result['userId'];

                // userid to name 
                $q = $this->connection()->prepare("SELECT * FROM user WHERE id = :userid"); 
                $q->bindParam(':userid', $user);
                $q->execute(); 

                $r = $q->fetch(PDO::FETCH_ASSOC);
                return '
                    <div class="media reactions">
                        <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
                        <div class="media-body">
                            <h5>'.$r['username'].'</h5>
                            <p class="comment">' . $result['reaction'] . '</p>
                        </div>
                    </div>';
                
            
            }
    }

    public function addNewComment(){
        $reaction = $this->getReaction(); 
        $taskId = $this->getTaskId(); 
        $userId = $this->getUserId(); 
        $projectId = $this->getProjectId();

       try {
            $query = $this->connection()->prepare("INSERT INTO comment(reaction, taskId, userId, projectId) VALUES (:reaction, :taskid, :userid, :projectId);"); 
            $query->bindParam(':reaction', $reaction);
            $query->bindParam(':taskid', $taskId);
            $query->bindParam(':userid', $userId);
            $query->bindParam(':projectId', $projectId);
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function deleteCommentfromTaskId(){
        // delete comment from task
        try {
            $query = $this->connection()->prepare("DELETE FROM comment WHERE taskId = :id"); 
            $query->bindParam(':id', $this->taskId);
            $query->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function deleteCommentfromProjectId(){
        $projectId = $this->getProjectId(); 
        // delete comment from project
        try {
            $query = $this->connection()->prepare("DELETE FROM comment WHERE projectId = :id"); 
            $query->bindParam(':id', $projectId);
            $query->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function test(){
        $reaction = $this->getReaction(); 
        $taskId = 1; 
        $userId = $this->getUserId(); 
        $projectId = 1;
        
       try {
            $query = $this->connection()->prepare("INSERT INTO comment(reaction, taskId, userId, projectId) VALUES (:reaction, :taskid, :userid, :projectId);"); 
            $query->bindParam(':reaction', $reaction);
            $query->bindParam(':taskid', $taskId);
            $query->bindParam(':userid', $userId);
            $query->bindParam(':projectId', $projectId);
            $query->execute(); 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

}

?>