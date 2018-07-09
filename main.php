<?php

// only show this page when user is logged in
session_start(); 

// check is session username exists
if(isset ($_SESSION['username'])){
    //echo $_SESSION['username'];
} else {
    header('Location: index.php');
}

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Project.php"); 

// make new project
$project = new Project(); 
$project->setTitle("PHP"); 
$project->setAdminId(1); 
$project->saveToDatabase(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- left -->
            <div class="col-md-3">
                <div class="profile">
                    <div class="icons">
                        <i class="fa fa-volume-down"></i>
                        <i class="fa fa-cog"></i>
                    </div>
                    <img src="img/user.png" alt="user">
                    <h1>Caroline Van Gossum</h1>
                    <h2>Student IMD</h2>

                    <div class="searchbox">
                        <i class="fas fa-search"></i>
                        <input type="search" class="form-control" placeholder="Search" />
                    </div>
                </div>

                <div class="addproject">
                    <i class="fas fa-plus"></i>
                    <button class="btn btn-add" type="button">Add Project</button>
                </div>

                <!-- accordion projecten -->
                <div role="tablist" id="accordion-1">

                    <!-- project webtech -->
                    <div class="card">
                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <i class="fas fa-book"></i>
                                <a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1">Webtech</a>
                            </h5>
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

                    <!-- project Mobile Development -->
                    <div class="card">

                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <i class="fas fa-book"></i>
                                <a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1">Webtech</a>
                            </h5>
                        </div>
                        <div class="collapse item-2" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis
                                    in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                            </div>
                        </div>
                    </div>

                    <!-- project Communicatie -->
                    <div class="card">

                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <i class="fas fa-book"></i>
                                <a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1">Webtech</a>
                            </h5>
                        </div>
                        <div class="collapse item-3" role="tabpanel" data-parent="#accordion-1">
                            <div class="card-body">
                                <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis
                                    in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
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
                    <!-- item -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>Landing Page&nbsp;
                                        <span>EXPIRING</span>
                                    </h5>
                                    <p>by Daniel Cifferton</p>
                                </div>
                                <input class="mycheckbox" id="mycheckbox1" type="checkbox" value="value1">
                                <label for="mycheckbox1"></label>
                            </div>
                        </div>
                        <hr>
                    </li>

                    <!-- item -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>Landing Page&nbsp;
                                        <span>EXPIRING</span>
                                    </h5>
                                    <p>by Daniel Cifferton</p>
                                </div>
                                <input class="mycheckbox" id="mycheckbox1" type="checkbox" value="value1">
                                <label for="mycheckbox1"></label>
                            </div>
                        </div>
                        <hr>
                    </li>

                    <!-- item -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>Landing Page&nbsp;
                                        <span>EXPIRING</span>
                                    </h5>
                                    <p>by Daniel Cifferton</p>
                                </div>
                                <input class="mycheckbox" id="mycheckbox1" type="checkbox" value="value1">
                                <label for="mycheckbox1"></label>
                            </div>
                        </div>
                        <hr>
                    </li>

                    <!-- item -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>Landing Page&nbsp;
                                        <span>EXPIRING</span>
                                    </h5>
                                    <p>by Daniel Cifferton</p>
                                </div>
                                <input class="mycheckbox" id="mycheckbox1" type="checkbox" value="value1">
                                <label for="mycheckbox1"></label>
                            </div>
                        </div>
                        <hr>
                    </li>

                    <!-- item -->
                    <li class="list-group-item">
                        <div class="media">
                            <img src="img/user.png" alt="user">
                            <div class="media-body">
                                <div class="media-text">
                                    <h5>Landing Page&nbsp;
                                        <span>EXPIRING</span>
                                    </h5>
                                    <p>by Daniel Cifferton</p>
                                </div>
                                <input class="mycheckbox" id="mycheckbox1" type="checkbox" value="value1">
                                <label for="mycheckbox1"></label>
                            </div>
                        </div>
                        <hr>
                    </li>

                </ul>
            </div>

            <!-- right -->
            <div class="col-md-3">
                <div class="menu">
                    <span>5</span>
                    <i class="fa fa-bell"></i>
                    <button class="btn" type="button">Add Task</button>
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

    <!-- scripts -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</body>

</html>