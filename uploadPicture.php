<?php
if (isset($_POST['submit'])){
    echo "ok"; 
    $img = $_FILES['uploadimg'];
    //print_r($file); 

    //name
    $imgName = $_FILES['img']['name'];

    // get extension after . 
    $imgExtension = explode('.', $imgName); 
    $imgExt = strtolower(end($imgExtension));

    // only allow images 
    $images = array('jpg', 'jpeg', 'png');

}
?>