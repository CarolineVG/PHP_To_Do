<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 
include_once("classes/User.php"); 

if (!empty($_POST)){
    // get values
    $title = $_POST['taskname'];
    $workhours = $_POST['workhours'];
    $deadline = $_POST['deadline'];

                /** add project */
                $project = new Task(); 
                $project->setTitle($title);
                $project->setWorkhours($workhours);
                $project->setDeadline($deadline);

                // new task
                $task = new Task(); 

                // new user
                $user = new User(); 
                $userId = $user->getUserIdByName($_SESSION['username']);
                
                // give userid to task
                $task->setUserId($userId); 

                // current date
                // default timezone
                date_default_timezone_set('Europe/Brussels');

                // today
                $today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
                $today = date("d-m-Y");
                
                $task->setDeadline($today); 
                $task->setTaskStatus("not started");
                $task->setStartDate($today);
                $task->setProjectId(1); 


                try {
                    $task->addNewTask(); 
                } catch (Exception $e) {
                    $error = $e->getMessage(); 
                }
}


?>
  <ul class="dropdown-menu dropdown-task">
    <form method="post">

        <div class="form-group">
            <input class="form-control" type="text" name="taskname" id="taskname" placeholder="Task name">
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
  </ul>