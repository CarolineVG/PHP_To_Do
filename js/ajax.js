$("#submitcomment").on("click", function(e){
    var comment = $("#message").val();
    var taskid = $(".task_wrapper").attr('id'); 

    console.log(taskid); 


    $.ajax({
        method: "POST",
        url: "ajax/addComment.php",
        data: { comment: comment, taskid: taskid}
   })
   .done(function(res) { 
   
       if(res.status == "success") {
           // show new comment
          var output = res.output;
           
           console.log("toegevoegd"); 
          $(".reactions").append(output);
          $("#message").val("");
       } 
   })
   .fail(function(err){
    console.log(err.status); 
   });

    e.preventDefault();
});

/*
                        <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
                        <div class="media-body">
                            <h5>'.$r['username'].'</h5>
                            <p class="comment">' . $result['reaction'] . '</p>
                        </div>*/