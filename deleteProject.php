<?php

echo "ja"; 
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 

/** SESSION */
session_start();

// get id of project
    $id = $_GET['post'];
    echo $id; 

    /** delete project */
    $project = new Project(); 
    $project->setProjectId($id);

    try {
        $project->deleteProject(); 
        header("Location: main.php");
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }

?>