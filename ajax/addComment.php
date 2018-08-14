<?php

/** INCLUDES */
include_once("../classes/Database.php"); 
include_once("../classes/Task.php"); 
include_once("../classes/User.php"); 
include_once("../classes/Comment.php");

/** SESSION */
session_start(); 

// new user
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);

if(!empty($_POST)){
    $value = $_POST['comment'];
    $taskId = $_POST['taskid'];

    // add to database 
    $comment = new Comment();
    $comment->setReaction($value);
    $comment->setUserId($userId); 
    $comment->setTaskId($taskId); 

    // get project id from task
    $task = new Task();
    $task->setTaskId($taskId); 
    $projectId = $task->getProjectIdByTaskId();

    // set project id
    $comment->setProjectId($projectId); 

    try {
        $comment->addNewComment(); 
        $id = $comment->getIdFromDb(); 
        // feedback
        $response['status'] = 'success'; 
        $response['output'] = $id;  
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}

header('Content-type: application/json');
echo json_encode($response);

?>