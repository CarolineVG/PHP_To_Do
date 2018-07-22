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
        <form method="post" action="uploadPicture.php" enctype="multipart/form-data">
            <h2 class="sr-only">Register Form</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"> <?php echo $error ?>
            </div>
            <?php endif ?>

            <!-- upload picture --> 

            <div class="form-group">
                <input class="form-control" type="file" name="uploadimg" id="uploadimg">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="submit">Upload Image</button>
            </div>
            <a href="login.php" class="loginlink">Login</a>
        </form>
    </div>
</body>

</html>