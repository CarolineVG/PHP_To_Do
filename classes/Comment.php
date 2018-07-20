<?php

class Comment extends Database {

    /** variables */
    private $reaction;
    private $taskId; 
    private $userId;

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

    /** functions */
    public function showCommentsFromTask(){
        try {
            $query = $this->connection()->prepare("SELECT * FROM comment WHERE taskId = :id"); 
            $query->bindParam(':id', $this->taskId);
            $query->execute(); 
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                // userid to name 
                $q = $this->connection()->prepare("SELECT * FROM user WHERE id = :userid"); 
                $q->bindParam(':userid', $this->userId);
                $q->execute(); 

                while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo '<h5>'.$r['username'].'</h5>
                    <p class="comment">' . $result['reaction'] . '</p>';
                }
            
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }

    public function addNewComment(){
        $reaction = $this->getReaction(); 
        $taskId = $this->getTaskId(); 
        $userId = $this->getUserId(); 

       try {
            $query = $this->connection()->prepare("INSERT INTO comment(reaction, taskId, userId) VALUES (:reaction, :taskid, :userid);"); 
            $query->bindParam(':reaction', $reaction);
            $query->bindParam(':taskid', $taskId);
            $query->bindParam(':userid', $userId);
            $query->execute(); 
            echo "ok"; 

        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
}

?>