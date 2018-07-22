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
                    //echo '<img src="'. $user->getImage(). '" alt="'. $user->getImage(). '">';
                    echo '<h1>' . $user->getUsername() . '</h1>' ?>
                    <h2>Student IMD</h2>

                </div>

                <div class="addproject">
                    <i class="fas fa-plus"></i>
                    <a href="newProject.php" class="btn btn-add">Add Project</a>
                </div>

                
                <div class="addproject">
                    <i class="fas fa-plus"></i>
                    <a href="joinProject.php" class="btn btn-add">Join Project</a>
                </div>

                

                <!-- accordion projecten -->
                <div role="tablist" id="accordion-1">

                <?php
                    /** show projects */
                    $project = new Project();
                    $project->showProjects($user->getUserId());
                ?>

                </div>
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
                    } else {
                        $projectId = 1;
                    }
                    
                    $task->setProjectId($projectId); 
                    $task->showTasksFromProject(); 
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
                                <a class="dropdown-item" href="#">x</a>
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
                            <button class="btn btn-primary btn-block" type="submit" name="submit">Filter</button>
                        </div>
                    </div>
                </form>
    
                    
                
  <!--<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose your project
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
    </ul>
  </div>-->

                
                <?php include_once("deadlines.php"); ?>

                <!--
                <ul class="list-group">


                    
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="mediabody">
                                <h5>Carry Jenkingson</h5>
                                <p>PHP Developer</p>
                            </div>
                        </div>
                    </li>

                </ul> -->
            </div>
        </div>
    </div>
<?php 
/** footer */
include_once("footer.php"); 
?>