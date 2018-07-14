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

if (!empty($_POST)){
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
}


/** header */
include_once("header.php"); 
?>


<li class="list-group-item">
                <div class="media">
                    <img src="img/user.png" alt="user">
                    <div class="media-body">
                        <div class="media-text">
                            <h5>taak&nbsp;<span>busy</span></h5>
                            <p>caroline</p>
                        </div>
                        <input class="checkbox" type="checkbox">
                    </div>
                </div>
                <hr>
                    <div class="media">
                        <div class="media-body">
                            <div class="media-text">
                            <?php 
                            // show comments
                            /*$comment = new comment(); 
                            $comment->setTaskId(3); 
                            $comment->showCommentsFromTask(); */
                            ?>
                                <h5>Caroline Van Gossum</h5>
                                <p class="comment">This is my reaction</p>
                            </div>
                        </div>                    
                        <img src="img/user.png" alt="user">
                    </div>
                    
                    <hr>
                    <form id="mycomment" action="">
                        <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
                        <input type="submit" value="Add Comment">
                    </form>
            </li>
            <?php 
/** footer */
include_once("footer.php"); 
?>