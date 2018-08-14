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

                <div class="students">
                    <h1>Work Scheme</h1>
                    <h2>This week</h2>


                    <?php
                    $task = new Task; 
                    $task->showWeeklyDeadlines();
                    
                    ?>

                    <h2>Next week</h2>

                </div>

            </div>

            <!-- right -->
            <div class="col-md-3">
                <div class="menu">
                    <a class="btn" href="register.php">Add Admin</a>
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
            </div>
        </div>
    </div>
<?php 
/** footer */
include_once("footer.php"); 
?>