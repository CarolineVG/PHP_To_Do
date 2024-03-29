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

/** USER */
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);

/** header */
include_once("header.php"); 

// get task id 
$taskid = $_GET['post'];


if (!empty($_POST)){
    // get values
    $title = $_POST['taskname'];
    $workhours = $_POST['workhours'];    
    $startdate = $_POST['startdate'];
    $deadline = $_POST['deadline'];
    $projectname = $_POST['projectname'];
    echo $projectname; 

    $project = new Project(); 
    $project->setTitle($projectname); 
    $projectid =  $project->getProjectIdByName(); 

    if(isset($_POST['submit'])){
        echo "ok"; 
        
                // new task
                $task = new Task(); 
                $task->setTaskId($taskid);
                $task->setTitle($title);
                $task->setWorkhours($workhours);
                $task->setProjectId($projectid); 
                $task->setDeadline($deadline); 
                $task->setUserId($userId); 

                    try {
                        $task->editTask(); 
                        header("Location: taskDetail.php?task=". $taskid); 
                    } catch (Exception $e) {
                        $error = $e->getMessage(); 
                    }

    }
}



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

            <?php 
                // show current values 
                $task = new Task();
                $task->setTaskId($taskid); 
                $task->showEditTask(); 
            ?>
        
    </form>
</div>
    
<?php 
/** footer */
include_once("footer.php"); 
?>