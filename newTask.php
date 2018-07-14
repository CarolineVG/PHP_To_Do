<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 
include_once("classes/User.php"); 

if (!empty($_POST)){
    // get values
    if (isset($_POST['title'])) {
        $title = $_POST['taskname'];

        if (isset($_POST['workhours'])) {
            $workhours = $_POST['workhours'];

            if (isset($_POST['deadline'])) {
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
                $task->setStartDate("14/07/2018");

                try {
                    $task->addNewTask(); 
                    echo "ok"; 
                } catch (Exception $e) {
                    $error = $e->getMessage(); 
                }
            }
        }
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