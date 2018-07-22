<?php
if (isset($_POST['submit'])){
    echo "ok"; 
    $img = $_FILES['uploadimg'];
    print_r($img); 

    //name
    $imgName = $_FILES['uploadimg']['name'];

    // get extension after . 
    $imgExtension = explode('.', $imgName); 
    $imgExt = strtolower(end($imgExtension));

    // only allow images 
    $images = array('jpg', 'jpeg', 'png');

    // check if file is img
    if (in_array($imgExt, $images)){
        echo "ok img"; 
    } else {
        echo "file is not an image"; 
    }

}
?>