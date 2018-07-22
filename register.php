<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/User.php"); 


if (!empty($_POST)){
    if (empty($_POST['name'])){
        $error = "Please enter a username. \r\n"; 
    } else if (empty($_POST['email'])){
        $error .= "Please enter an email. \r\n"; 
    } else if (empty($_POST['education'])){
        $error .= "Please enter an education. \r\n"; 
    } else if (empty($_POST['password'])){
        $error .= "Please enter a password. \r\n"; 
    } else if (empty($_POST['password2'])){
        $error .= "Please repeat your password. \r\n"; 
    } else {
        // add values to variables
        $username = $_POST['name'];
        $mail = $_POST['email'];
        $education = $_POST['education'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
               
        try {
            // make new user 
            $user = new User;

            // assign values to user
            $user->setUsername($username);
            $user->setMail($mail); 
            $user->setEducation($education);
            $user->setPassword($password);
            $user->setPassword2($password2); 

            try {
                // check passwords
                $user->checkPasswords();

                // check register
                $user->checkRegister();

                // hash password
                $hashed = $user->hashPassword();
                $user->setHash($hashed); 
                            
                // register
                $user->register();

            } catch (Exception $e){
                // show error
                $error = $e->getMessage();
            }

        } catch (Exception $e){
            // show error
            $error = $e->getMessage();        
        }     
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
</head>

<body>
    <div class="login">
        <form method="post" enctype="multipart/formdata">
            <h2 class="sr-only">Register Form</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"> <?php echo $error ?>
            </div>
            <?php endif ?>
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="education" placeholder="Education">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password2" placeholder="Repeat Password">
            </div>
            
            <!-- upload picture --> 

            <div class="form-group">
                <input class="form-control" type="file" name="img" id="img">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="submit">Create Account</button>
            </div>
            <a href="login.php" class="loginlink">Login</a>
        </form>
    </div>
</body>

</html>