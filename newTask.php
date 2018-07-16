<?php

/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 
include_once("classes/User.php"); 
include_once("classes/Project.php"); 

/** SESSION */
session_start();
$user = new User(); 
  
        

if (!empty($_POST)){
    // get values
    $title = $_POST['taskname'];
    $workhours = $_POST['workhours'];
    $deadline = $_POST['deadline'];

                // new task
                $task = new Task(); 
                $task->setTitle($title);
                $task->setWorkhours($workhours);
                $task->setDeadline($deadline);

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

/** header */
include_once("header.php"); 
?>
<div class="login">
<form method="post">
<h2>New Task</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert"> <?php echo $error ?>
                </div>
            <?php endif ?>
        <div class="form-group">
            <input class="form-control" type="text" name="taskname" id="taskname" placeholder="Task name">
        </div>

        <div class="form-group">
        <select class="form-control" id="sel1">
            <option> Project </option>
            <?php
            // show projects
            $project = new Project();
            $userId = $user->getUserIdByName($_SESSION['username']);
            $project->setUserId($userId); 
            $project->showProjectsInDropdown();     
            ?>
        </select>
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="workhours" id="workhours" placeholder="Work hours">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="deadline" id="deadline" placeholder="Deadline">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Create Task</button>
        </div>
    </form>
</div>
    
<?php 
/** footer */
include_once("footer.php"); 
?>