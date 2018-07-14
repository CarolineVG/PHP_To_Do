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
                    <img src="img/user.png" alt="user">
                    <?php echo '<h1>' . $user->getUsername() . '</h1>' ?>
                    <h2>Student IMD</h2>

                    <div class="searchbox">
                        <i class="fas fa-search"></i>
                        <input type="search" class="form-control" placeholder="Search" />
                    </div>
                </div>

                <div class="addproject">
                    <i class="fas fa-plus"></i>
                    <a href="newProject.php" class="btn btn-add">Add Project</a>
                </div>
                <!-- accordion projecten -->
                <div role="tablist" id="accordion-1">

                <?php
                    /** show projects */
                    $project = new Project();
                    $project->showProjects($user->getUserId());
                ?>

                    <!-- project webtech -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <i class="fas fa-book"></i>
                                <a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1">not in db</a>
                                <i class="fas fa-trash-alt"></i></h5>
                        </div>
                        <div class="collapse show item-1" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-item">
                                        <a href="">All Tasks</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="">People</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="">Files</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="">Statistics</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle -->
            <div class="col-md-6">
                <div class="date">
                    <i class="fa fa-calendar-alt"></i>
                    <h3>Wednesday, 15th October, 2015</h3>
                </div>
                <ul class="list-group">

                <?php 
                    /** show tasks from project */
                    $task = new Task(); 
                    $task->setProjectId(1); 
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
                                <a class="dropdown-item" href="#">x</a>
                                <a class="dropdown-item" href="#">x</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="searchbox" id="s2">
                    <i class="fas fa-search"></i>
                    <input type="search" class="form-control" placeholder="Search" />
                </div>

                <ul class="list-group">

                    <!-- user -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="mediabody">
                                <h5>Carry Jenkingson</h5>
                                <p>PHP Developer</p>
                            </div>
                        </div>
                    </li>

                    <!-- user -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="mediabody">
                                <h5>Carry Jenkingson</h5>
                                <p>PHP Developer</p>
                            </div>
                        </div>
                    </li>

                    <!-- user -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="mediabody">
                                <h5>Carry Jenkingson</h5>
                                <p>PHP Developer</p>
                            </div>
                        </div>
                    </li>

                    <!-- user -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="mediabody">
                                <h5>Carry Jenkingson</h5>
                                <p>PHP Developer</p>
                            </div>
                        </div>
                    </li>

                    <!-- user -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="mediabody">
                                <h5>Carry Jenkingson</h5>
                                <p>PHP Developer</p>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
<?php 
/** footer */
include_once("footer.php"); 
?>