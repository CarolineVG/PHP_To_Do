<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 

if (!empty($_POST)){
    
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