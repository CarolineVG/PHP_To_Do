<?php
/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once("classes/Database.php");
include_once("classes/User.php");
include_once("classes/Task.php");


/** SESSION */
session_start();

/** USER */
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);
$user->setUserId($userId); 


if (isset($_POST['submit'])){
    echo "ok"; 
    $file = $_FILES['uploadfile'];
    print_r($file); 

    //name
    $fileName = $_FILES['uploadfile']['name'];

    // get extension after . 
    $fileExtension = explode('.', $fileName); 
    $fileExt = strtolower(end($fileExtension));

    // only allow pdf, word and excel 
    $docs = array('pdf', 'docx', 'xlsx');

    // check if file is pdf word or excel
    if (in_array($fileExt, $docs)){
        echo "ok"; 
    } else {
        echo "file is not a pdf, word or excel file"; 
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
        <form method="post" enctype="multipart/form-data">
            <h2 class="sr-only">Upload File</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>
            <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"> <?php echo $error ?>
            </div>
            <?php endif ?> 

            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" id="uploadfile">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="submit">Upload File</button>
            </div>
        </form>
    </div>
</body>

</html>