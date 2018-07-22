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

/** GET TASK ID */
$taskId = $_GET['task'];

// new user
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);

    if(isset($_POST['submit'])){
    // get values
    $text = $_POST['message'];

                // new comment
                $comment = new Comment();
                
                $comment->setReaction($text);
                
                // give userid to comment
                $comment->setUserId($userId); 

                // set task id 
                $comment->setTaskId($taskId);

                try {
                    $comment->addNewComment(); 
                    //header("Location: index.php"); 
                } catch (Exception $e) {
                    $error = $e->getMessage(); 
                }
    
}


/** header */
include_once("header.php"); 
?>

<div class="detailtask">
<li class="list-group-item detail-task">
    
<?php 
$task = new Task();
$task->setTaskId($taskId); 

echo '<a class="btn" href="uploadFile.php?task='. $taskId . '">Upload File</a>';

$task->showTaskFromId(); 
?>
                            <?php 
                                // show comments
                                $comment = new Comment();
                                $comment->setTaskid($taskId); 
                                $comment->setUserId($userId); 
                                $comment->showCommentsFromTask(); 
                            ?>
                          
                    <hr>

                    <!-- write reaction -->
                    <form id="mycomment" method="post">
                        <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
                        <input type="submit" name="submit" value="Add Comment">
                    </form>
</li>
</div>
<?php 
/** footer */
include_once("footer.php"); 
?>