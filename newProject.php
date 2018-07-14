<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 

if (!empty($_POST)){
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
            //echo "ok"; 
        } catch (Exception $e) {
            $error = $e->getMessage(); 
        }
}

?>

<form method="post">
    <div class="form-group">
        <input class="form-control" type="text" name="projectname" id="projectname" placeholder="Project Name">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block btnSaveNewProject" type="submit">Create Project</button>
    </div>
</form>