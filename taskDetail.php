<?php

/** ERRORS */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/Task.php"); 
include_once("classes/User.php"); 
include_once("classes/Comment.php"); 

/** SESSION */
session_start(); 

// get project id 


// new user
$user = new User(); 
$userId = $user->getUserIdByName($_SESSION['username']);

    if(isset($_POST['submit'])){
    // get values
    $text = $_POST['message'];

    // new comment
    $comment = new Comment();
    $comment->setReaction($text);
                
    // give userid to comment
    $comment->setUserId($userId); 

    // get task id
    $taskId = $_GET['task'];

    // set task id 
    $comment->setTaskId($taskId);

    // get project id from task
    $task = new Task();
    $task->setTaskId($taskId); 
    $projectId = $task->getProjectIdByTaskId();

    //echo 'project ' . $projectId; 

    // set project id
    $comment->setProjectId($projectId); 

    try {
        $comment->addNewComment(); 
        //header("Location: index.php"); 
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}


/** header */
include_once("header.php"); 
?>

<div class="detailtask">
<li class="list-group-item detail-task">
    
<?php 
$task = new Task();
$task->setTaskId($taskId); 
$task->showTaskFromId(); 

// show comments
$comment = new Comment();
$comment->setTaskid($taskId); 
$comment->setUserId($userId); 
$comment->showCommentsFromTask(); 
?>
<hr>

<!-- write reaction -->
<form id="mycomment" method="post">
    <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
    <a href="index.php" class="btn btn-back"><i class="fas fa-chevron-left"></i>Back</a>
    <input type="submit" class="btn btn-addcomment" name="submit" value="Add Comment" id="submitcomment">
    
    <?php  
        echo '<a class="btn btn-addcomment" href="uploadFile.php?task='. $taskId . '">Upload File</a>';
    ?>
</form>



</li>
</div>

<div id="result">test</div>

<script>
/*
$(document).ready(function(){
    $("#submitcomment").click(function(){
        echo "clicked"; 
        // run ajax 
        /*$.post("taskDetail.php", function(data){
            // show response
            $("#result").html(data); 
        });*/
     /*   
    $.ajax({
        type: "POST",
        url: "addComment.php",
        data: { reaction: reaction },
        
    }).done(function( res ) { //als ajax antwoord (echo) terugstuurt
        console.log("Data Saved: "+ res);
        $("#valueEditText").toggleClass('hidden visible');
        $("#formEditText").toggleClass('visible hidden');
        $("#editProfileText").show();
        $("#valueEditText").html(profile_text);
        
    }).fail(function(res)  {
       console.log("Sorry. Ajax failed");
    }); 
    });*/
//});




</script>

<?php 
/** footer */
include_once("footer.php"); 
?>