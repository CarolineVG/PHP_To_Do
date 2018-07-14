<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 

if (!empty($_POST)){
    // get values
    $title = $_POST['taskname'];
    $workhours = $_POST['workhours'];
    $deadline = $_POST['deadline'];

    /** add project */
    $project = new Task(); 
    $project->setTitle($title);
    
    $user = new User();
    $userId = $user->getUserIdByName($_SESSION['username']);
    $project->setAdminId($userId); 
    //echo $userId; 

    try {
        $project->saveToDatabase(); 
        //echo "ok"; 
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
            <button class="btn btn-primary btn-block btnSaveNewProject" type="submit">Create Task</button>
        </div>
    </form>
  </ul>