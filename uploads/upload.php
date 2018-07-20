<?php

if (issert($_POST['submit'])) {
    // get file
    $file = $_FILES['file'];

    // show name name 
    $fileName = $_FILES['file']['name'];   

    echo $fileName; 
}

?>