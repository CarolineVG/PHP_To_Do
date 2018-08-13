<?php

if(!empty($_POST["comment"])){
    $response['status'] = 'success';  
    $response['comment'] = htmlspecialchars($_POST['comment']);
} else {
    $response['status'] = 'error';  
}

header('Content-type: application/json');
echo json_encode($response);

?>