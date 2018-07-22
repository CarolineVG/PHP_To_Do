<?php
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
            $newImgName = uniqid('', true). '.' . $imgExt; 

            // file location
            $imgLocation = 'uploads/' . $newImgName; 

            // move file from tmp to uploads
            move_uploaded_file($_FILES['uploadimg']['tmp_name'], $imgLocation); 


            // upload img

        } else {
            echo "file size is max 1mb";
        }
    } else {
        echo "file is not an image"; 
    }

}
?>