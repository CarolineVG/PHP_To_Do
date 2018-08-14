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

/*if(isset($_POST['submit'])){
    $project = $_POST['projects'];
    //echo $project; 
    $task->setUserId($id); 
    $task->setProjectId($project); 
    $task->filterMyDeadlines(); 
} else {*/
    /** show tasks from project */
    /*$task = new Task();
    $task->setUserId($user->getUserId()); 
    $task->showMyDeadlines(); */
//}
?>