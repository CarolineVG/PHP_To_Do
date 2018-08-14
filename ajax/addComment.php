<?php

/** INCLUDES */
include_once("../classes/Database.php"); 
include_once("../classes/Task.php"); 
include_once("../classes/User.php"); 
include_once("../classes/Comment.php");

/** SESSION */
//session_start(); 

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(!empty($_POST)){
    $value = $_POST['comment'];
    // add to database 
    $comment = new Comment();
    $comment->setReaction($value);
    $comment->test();

    // send feedback 
    $response["status"] = "success";
    //$response['output'] = $output; 
}

header('Content-type: application/json');
echo json_encode($response);

?>