<?php

class Comment extends Database {

    /** variables */
    private $text;
    private $taskId; 
    private $userId;

    /** getters */
    public function getText(){
        return $this->text;
    }

    public function getTaskId(){
        return $this->taskId;
    }
    
    public function getUserId(){
        $query = $this->connection()->prepare("SELECT id FROM user WHERE username = :username"); 
        $query->bindParam(':username', $this->username);
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    /** setters */
    public function setText($text){
        $this->text = $text;
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
                echo $result['text'];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage);
        }
    }
}

?>