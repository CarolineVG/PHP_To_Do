<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 
include_once("classes/User.php"); 
include_once("classes/Task.php"); 

// only show this page when user is logged in
session_start(); 

// check is session username exists
if(isset ($_SESSION['username'])){
    //echo $_SESSION['username'];
    $user = new User();
    $user->setUsername($_SESSION['username']);
    $id = $user->getUserId();
    $user->setUserId($id);

} else {
    header('Location: login.php');
}

/** header */
include_once("header.php"); 
?>
    <div class="container">
        <div class="row">
            <!-- left -->
            <div class="col-md-3">
                <div class="profile">
                    <?php
                    echo $user->showUserImage(); 
                    echo '<h1>' . $user->getUsername() . '</h1>';
                    echo '<h2>' . $user->showEducation() . '</h2>';
                    
                    ?>

                </div>

                <div class="addproject">
                    <i class="fas fa-plus"></i>
                    <a href="newProject.php" class="btn btn-add">Add Project</a>
                </div>

                
                <div class="addproject">
                    <i class="fas fa-plus"></i>
                    <a href="joinProject.php" class="btn btn-add">Join Project</a>
                </div>

                

                <!-- my projects -->
                <div class="my-project">
                <h1>My Projects</h1>
                </div>
                <?php
                    /** show own projects */
                    $project = new Project();
                    $project->setUserId($user->getUserId()); 
                    $project->showProjects();
                ?>

                
                <div class="my-project">
                <h1>Joined Projects</h1>
                </div>
                <ul class="list-group">
                    <?php
                        /** show joined projects */
                        $project->showJoinedProjects();
                    ?>
                </ul>


            </div>
            <!-- middle -->
            <div class="col-md-6">
                <div class="date">
                    <i class="fa fa-calendar-alt"></i>
                    <?php
                        // source: http://pl.php.net/manual/en/function.date.php    
                        // default timezone
                        date_default_timezone_set('Europe/Brussels');
                        // show current date
                        echo '<h3>'. date('l jS \of F Y') .'</h3>';
                    ?>
                </div>

                <ul class="list-group">

                <?php 
                    /** show tasks from project */
                    $task = new Task();
                    /** GET PROJECT ID */
                    if (isset($_GET['project'])) {
                        $projectId = $_GET['project'];
                        $task->setProjectId($projectId); 
                        $task->showTasksFromProject(); 
                    } else {
                        echo "Select a project to see the tasks."; 
                    }
                    
                ?>
                
                </ul>
            </div>

            <!-- right -->
            <div class="col-md-3">
                <div class="menu">
                    <a class="btn" href="newTask.php">Add Task</a>
                    <div class="icons">
                        <i class="fa fa-bell"></i>
                        <div class="dropleft show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="updateProfile.php">Upload Profile Picture</a>
                            
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="post" class="formProject">
                    <div class="projectDropdown">
                        <select class="form-control" id="projects" name="projects">
                            <option>Choose your project </option>
                            <?php
                            // show projects
                            $project = new Project();
                            $userId = $user->getUserIdByName($_SESSION['username']);
                            $project->setUserId($userId); 
                            $project->showProjectsInDropdown();
                            ?>
                        </select>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block btn-filter" type="submit" name="submit">Filter</button>
                        </div>
                    </div>
                </form>

                <?php include_once("deadlines.php"); ?>
                
            </div>
        </div>
    </div>
<?php 
/** footer */
include_once("footer.php"); 
?>