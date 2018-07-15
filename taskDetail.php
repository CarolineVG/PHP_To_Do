<?php

/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 
include_once("classes/User.php"); 
include_once("classes/Comment.php"); 

/** SESSION */
session_start(); 



/*if (!empty($_POST)){
    // get values
    $text = $_POST['message'];

                // new comment
                $comment = new Comment(); 

                // new user
                $user = new User(); 
                $user->setText($text); 
                $userId = $user->getUserIdByName($_SESSION['username']);
                
                // give userid to comment
                $comment->setUserId($userId); 

                try {
                    $task->addNewComment(); 
                    //header("Location: index.php"); 
                } catch (Exception $e) {
                    $error = $e->getMessage(); 
                }
}*/


/** header */
include_once("header.php"); 
?>


<li class="list-group-item detail-task">
<?php 
/** GET TASK ID */
$taskId = $_GET['task'];
echo $taskId;

$task = new Task();
$task->setTaskId($taskId); 
$task->showTaskFromId(); 
?>
</li>
<?php 
/** footer */
include_once("footer.php"); 
?>