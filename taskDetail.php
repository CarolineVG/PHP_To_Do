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

    if(isset($_POST['submit'])){
    // get values
    $text = $_POST['message'];

                // new comment
                $comment = new Comment(); 

                // new user
                $user = new User(); 
                $comment->setReaction($text); 
                $userId = $user->getUserIdByName($_SESSION['username']);
                echo $userId; 
                
                // give userid to comment
                $comment->setUserId($userId); 

                // set project id 
                $comment->setTaskId(1);

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


<li class="list-group-item detail-task">
<?php 
/** GET TASK ID */
$taskId = $_GET['task'];
//echo $taskId;
$task = new Task();
$task->setTaskId($taskId); 
$task->showTaskFromId(); 
?>


            <div class="media">
            <img src="img/user.png" alt="user">
            <div class="media-body">
                <div class="media-text">
                    <h5>title<span>nog iets</span>
                    <span class="deadline"> zoveel dagen nog</h5>
                    <p>naam</p>
                </div>

                <div class="taskicons">
                    <a href=""><i class="fas fa-pencil-alt"></i></a>
                    <a href=""><i class="fas fa-trash-alt"></i></a>
                    <input class="checkbox" type="checkbox">
                </div>
            </div>
            </div>
            <hr>

            <div class="media">
                        <div class="media-body">
                            <div class="media-text">
                                <h5>Caroline Van Gossum</h5>
                                <p class="comment">This is my reaction</p>
                            </div>
                        </div>                    
                        <img src="img/user.png" alt="user">
                    </div>
                    <hr>

                    <!-- write reaction -->
                    <form id="mycomment" method="post">
                        <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
                        <input type="submit" name="submit" value="Add Comment">
                    </form>
</li>
<?php 
/** footer */
include_once("footer.php"); 
?>