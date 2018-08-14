<?php
/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once(__ROOT__."classes/Database.php");
include_once(__ROOT__."classes/User.php");

/** SESSION */
session_start();

/** USER */
$user = new User(); 
$user->setUsername($_SESSION['username']); 
$userId = $user->getUserIdByName($_SESSION['username']);
$user->setUserId($userId); 


if (isset($_POST['submit'])){
    $img = $_FILES['uploadimg'];
    //print_r($img); 

    //name
    $imgName = $_FILES['uploadimg']['name'];

    // get extension after . 
    $imgExtension = explode('.', $imgName); 
    $imgExt = strtolower(end($imgExtension));

    // only allow images 
    $images = array('jpg', 'jpeg', 'png');

    // check if file is img
    if (in_array($imgExt, $images)){
        //echo "ok img"; 

        // check img size - max 1mb 
        if ($_FILES['uploadimg']['size'] < 100000000){
            //echo "size ok"; 

            // change name to user id 
            $newImgName = $userId . '.' . $imgExt; 

            // file location
            $imgLocation = 'uploads/' . $newImgName; 

            // move file from tmp to uploads
            move_uploaded_file($_FILES['uploadimg']['tmp_name'], $imgLocation);     
            
            // insert filename into database
            $user->setImage($imgLocation); 
            $user->uploadUserPicture(); 
            
            // check if admin
            if ($user->checkAdmin()) {
                echo 'admin'; 
                header("Location: adminView.php"); 
            } else {
                header("Location: index.php"); 
            }


        } else {
            echo "file size is max 1mb";
        }
    } else {
        echo "file is not an image"; 
    }

}
?>