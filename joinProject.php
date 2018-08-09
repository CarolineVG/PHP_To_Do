<?php

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 
include_once("classes/User.php"); 

/** SESSION */
session_start(); 

$user = new User(); 
$user->setUsername($_SESSION['username']);
$id = $user->getUserId();


if(isset($_POST['submit'])){
    // get value from dropdown
    $project = new Project(); 
    $projectid = $_POST['projects'];

    // join project
    $project->setProjectId($projectid); 
    $project->setUserId($id); 
    $project->joinProject();
    header("Location: index.php");
}

/** header */
include_once("header.php"); 
?>

<div class="login">
<form method="post">
<h2>Join A Project</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="form-group">
            <div class="projectDropdown">
                        <select class="form-control" id="projects" name="projects">
                            <option>Choose project </option>
                            <?php
                            // show projects
                            $project = new Project();
                            $project->showAllProjectsInDropdown();
                            ?>
                        </select>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" name="submit">Join Project</button>
                        </div>
		<div class="form-group">
			<a href="index.php" class="btn btn-block btn-red">Back</a>
        </div>
                    </div>
            </div>
    </form>
</div>
    
<?php 
/** footer */
include_once("footer.php"); 
?>