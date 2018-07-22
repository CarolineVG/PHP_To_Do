<?php
/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once("classes/Database.php");
include_once("classes/User.php");

/** SESSION */
session_start();

/** USER */
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);


if (isset($_POST['submit'])){
    echo "ok"; 
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
        if ($_FILES['uploadimg']['size'] < 100000){
            echo "size ok"; 

            // change img name - give uniq id
            //$newImgName = uniqid('', true). '.' . $imgExt; 

            // change name to user id 
            $newImgName = $userId . '.' . $imgExt; 

            // file location
            $imgLocation = 'uploads/' . $newImgName; 

            // move file from tmp to uploads
            move_uploaded_file($_FILES['uploadimg']['tmp_name'], $imgLocation);             

        } else {
            echo "file size is max 1mb";
        }
    } else {
        echo "file is not an image"; 
    }

}
?>