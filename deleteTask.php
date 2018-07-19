<?php

echo "ja"; 
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 

/** SESSION */
session_start();

// get id of project
    $id = $_GET['post'];
    echo $id; 

    /** delete project */
    $task = new Project(); 
    $task->setTaskId($id);

    try {
        $task->deleteProject(); 
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }

?>