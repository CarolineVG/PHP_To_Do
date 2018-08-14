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
    $value = $_POST['projectId'];

    // select from database 
    $task = new Task();
    $task->setUserId($userId); 
    $task->setProjectId($value); 
     
    try {
        $output = $task->filterMyDeadlines(); 
        // feedback
        $response['status'] = 'success'; 
        $response['output'] = $output;  
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}

header('Content-type: application/json');
echo json_encode($response);

?>