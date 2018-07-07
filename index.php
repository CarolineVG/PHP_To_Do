<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/User.php"); 

$user = new User;
$user->checkLogin("Caroline"); 

if (!empty($_POST)){
    // get values
    $username = $_POST['user'];
    $password = $_POST['password'];
    

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
</head>

<body>
    <div class="login">
        <form method="post">
            <h2>To Do Application</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="user" placeholder="Username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
            </div>
            <a href="#" class="registerlink">Register here</a>
        </form>
    </div>
</body>

</html>