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

/** header */
include_once("header.php"); 
?>

<div class="login">
<form method="post">
<h2>Edit Task</h2>
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
            <input class="form-control" type="text" name="workhours" id="workhours" placeholder="Work hours">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="startdate" id="startDate" placeholder="Start date">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="deadline" id="deadline" placeholder="Deadline">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="taskStatus" id="taskStatus" placeholder="Status">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" name="submit">Edit Task</button>
        </div>
    </form>
</div>
    
<?php 
/** footer */
include_once("footer.php"); 
?>