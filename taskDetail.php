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

// get task id 
$taskId = $_GET['task'];


// new user
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);

    if(isset($_POST['submit'])){

        // check if not empty
        if (empty($_POST['message'])){
            $error = "Please enter a message."; 
        } else {
        // get values
        $text = $_POST['message'];

        // new comment
        $comment = new Comment();
        $comment->setReaction($text);
                    
        // give userid to comment
        $comment->setUserId($userId); 

        // set task id 
        $comment->setTaskId($taskId);

        // get project id from task
        $task = new Task();
        $task->setTaskId($taskId); 
        $projectId = $task->getProjectIdByTaskId();

        //echo 'project ' . $projectId; 

        // set project id
        $comment->setProjectId($projectId); 

        try {
            $comment->addNewComment(); 
            //header("Location: index.php"); 
        } catch (Exception $e) {
            $error = $e->getMessage(); 
        }
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
$task->showTaskFromId(); 

// show comments
/*$comment = new Comment();
$comment->setTaskid($taskId); 
$comment->setUserId($userId); 
$comment->showCommentsFromTask(); */
?>
<hr>

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

<div id="result">test</div>

<?php 
/** footer */
include_once("footer.php"); 
?>