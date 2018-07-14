<?php

/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 
include_once("classes/User.php"); 

/** SESSION */
session_start(); 

if (!empty($_POST)){
    // get values
    $text = $_POST['message'];

                // new comment

                // new user
                $user = new User(); 
                $userId = $user->getUserIdByName($_SESSION['username']);
                
                // give userid to task
                $task->setUserId($userId); 

                // current date
                // default timezone
                date_default_timezone_set('Europe/Brussels');

                // today
                $today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $today = date("Y-m-d");
                
                $task->setDeadline($deadline); 
                $task->setTaskStatus("not started");
                $task->setStartDate($today);
                $task->setProjectId(1); 


                try {
                    $task->addNewTask(); 
                    header("Location: index.php"); 
                } catch (Exception $e) {
                    $error = $e->getMessage(); 
                }
}
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
                <!-- hidden -->
                <div class="comment-hidden">
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
                    <form id="mycomment" action="">
                        <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
                        <input type="submit" value="Add Comment">
                    </form>
                </div>
            </li>