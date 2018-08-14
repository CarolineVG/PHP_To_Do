<?php

echo "ja"; 
/** INCLUDES */
include_once(__ROOT__."classes/Database.php"); 
include_once(__ROOT__."classes/Task.php"); 

/** SESSION */
session_start();

// get id of project
    $id = $_GET['post'];
    echo $id; 

    /** delete task */
    $task = new Task(); 
    $task->setTaskId($id);

    // delete comments from task
    $comment = new Comment(); 
    $comment->setTaskId($id); 

    try {
        $task->deleteTask(); 
        $comment->deleteCommentfromTaskId();
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }

?>