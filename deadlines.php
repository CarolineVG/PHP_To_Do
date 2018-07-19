<?php
// check is session username exists
if(isset ($_SESSION['username'])){
    //echo $_SESSION['username'];
    $user = new User();
    $user->setUsername($_SESSION['username']);
    $id = $user->getUserId();
    $user->setUserId($id);

} else {
    header('Location: login.php');
}

/** header */
include_once("header.php"); 

/** show tasks from project */
$task = new Task();
$task->setUserId($user->getUserId()); 
/*$task->showMyDeadlines(); */

$task->setProjectId(1); 
$task->filterMyDeadlines(); 


?>