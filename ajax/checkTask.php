<?php

/** INCLUDES */
include_once("../classes/Database.php"); 
include_once("../classes/Task.php"); 
include_once("../classes/User.php"); 

/** SESSION */
session_start(); 

// new user
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);

if(!empty($_POST)){
    $value = $_POST['taskId'];

    // select from database 
    $task = new Task();
    $task->setTaskId($value); 
    $task->setUserId($userId);
     
    try {
        $task->taskIsDone();
        // feedback
        $response['status'] = 'success'; 
        $response['output'] = 'DONE';  
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}

header('Content-type: application/json');
echo json_encode($response);

?>