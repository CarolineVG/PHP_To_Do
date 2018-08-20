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

// get user id
$user = new User(); 
$user->setUsername($_SESSION['username']);
$userId = $user->getUserId();

// get task id 
$taskId = $_GET['task'];

/** header */
include_once("header.php");
?>

<div class="detailtask">
<li class="list-group-item detail-task">
    
<?php 
// show task
$task = new Task();
$task->setTaskId($taskId); 
$task->setUserId($userId); 

$task->showTaskFromId(); 

// show comments
$comment = new Comment();
$comment->setTaskId($taskId); 
$comment->showCommentsFromTask(); 
?>

<!-- show comments -->
<div class="allreactions">

</div>

<!-- write reaction -->
<form id="mycomment" method="post">
    <?php if(isset($error) ): ?>
        <div class="error error-message"><p><?php echo $error ?></p></div>
    <?php endif; ?>

    <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>

    <a href="index.php" class="btn btn-back"><i class="fas fa-chevron-left"></i>Back</a>

    <input type="submit" class="btn btn-addcomment" name="submitcomment" value="Add Comment" id="submitcomment">
    
    <?php echo '<a class="btn btn-addcomment" href="uploadFile.php?task='. $taskId . '">Upload File</a>'; ?>
    
</form>
</li>
</div>

<?php 
/** footer */
include_once("footer.php"); 
?>