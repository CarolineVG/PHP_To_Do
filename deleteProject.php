<?php
/** INCLUDES */
include_once(__ROOT__."classes/Database.php"); 
include_once(__ROOT__."classes/Project.php");  
include_once(__ROOT__."classes/Task.php"); 
include_once(__ROOT__."classes/Comment.php"); 

/** SESSION */
session_start();

// get id of project
    $id = $_GET['project'];
    echo $id; 

    /** delete project */
    $project = new Project(); 
    $project->setProjectId($id);
     
        // delete all tasks with project id 
        $task = new Task; 
        $task->setProjectId($id); 

        // delete all comments with task id 
        $comment = new Comment; 
        $comment->setProjectId($id);  

    try {
        $project->deleteProject();
        $task->deleteTasksByProjectId(); 
        $comment->deleteCommentfromProjectId(); 
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }

?>