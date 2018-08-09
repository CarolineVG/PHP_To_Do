<?php
/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once ("classes/Database.php");
include_once ("classes/Project.php");
include_once ("classes/User.php");

/** SESSION */
session_start();

if (isset($_POST['submit'])){

	// check if not empty
	if (empty($_POST['projectname'])){
		$error = "Please enter a project."; 
	} else {
		$title = $_POST['projectname'];
	
		/** add project */
		$project = new Project();
		$project->setTitle($title);
		$user = new User();
		$userId = $user->getUserIdByName($_SESSION['username']);
		$project->setCreator($userId);
	
		// echo $userId;
	
		try{
			$project->saveToDatabase();
			$project->saveToProjectUser(); 
	
			// echo "ok";
			header("Location: index.php");
	
			}
	
		catch(Exception $e)
			{
			$error = $e->getMessage();
			}
		}
	}


	

/** header */
include_once ("header.php");

?>
<div class="login">
<form method="post">
<h2>New Project</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert"> <?php echo $error ?> </div>
            <?php endif ?>

            <div class="form-group">
                <input class="form-control" type="text" name="projectname" id="projectname" placeholder="Project Name">
            </div>
            
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" name="submit">Create Project</button>
		</div>
		
		<div class="form-group">
			<a href="index.php" class="btn btn-block btn-red">Back</a>
        </div>

    </form>
</div>
    
<?php
/** footer */
include_once ("footer.php");

?>