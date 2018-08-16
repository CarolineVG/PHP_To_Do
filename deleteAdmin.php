<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Admin.php");  

/** SESSION */
session_start();

// get id of admin
    $id = $_GET['admin'];
    echo $id; 

    /** delete admin */
    $admin = new Admin(); 
    $admin->setAdminId($id); 

    try {
        $admin->deleteAdmin();
        header("Location: adminView.php");
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }

?>