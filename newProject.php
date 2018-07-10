<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 

if (!empty($_POST)){
    // get values
    $title = $_POST['projectname'];

    /** add project */
    $project = new Project(); 
    $project->setTitle($title);
    
    $user = new User();
    $userId = $user->getUserIdByName($_SESSION['username']);
    $project->setAdminId($userId); 
    //echo $userId; 

    try {
        $project->saveToDatabase(); 
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}

?>

<form method="post">
    <div class="form-group">
        <input class="form-control" type="text" name="projectname" placeholder="Project Name">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">Create Project</button>
    </div>
</form>