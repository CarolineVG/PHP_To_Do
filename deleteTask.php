<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php");
include_once("classes/User.php");
include_once("classes/Comment.php"); 

/** SESSION */
session_start();

// get user id
$user = new User(); 
$user->setUsername($_SESSION['username']);
$userId = $user->getUserId();
$user->setUserId($userId); 

// get id of project
    $id = $_GET['post'];
    
    /** delete task */
    $task = new Task(); 
    $task->setTaskId($id);
    $task->setUserId($userId); 

    // delete comments from task
    $comment = new Comment(); 
    $comment->setTaskId($id); 

    try { 
        $task->checkUserDeleteTask(); 
        $task->deleteTask(); 
        $comment->deleteCommentfromTaskId();
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage(); 
        header("Location: index.php");
    }

?>