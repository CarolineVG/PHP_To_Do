// comments
$("#submitcomment").on("click", function(e){
    var comment = $("#message").val();
    var taskid = $(".task_wrapper").attr('id'); 

    if (comment != ""){
        $.ajax({
            method: "POST",
            url: "ajax/addComment.php",
            data: {comment: comment, taskid: taskid}
        })
        .done(function(res) { 
        
            if(res.status == "success") {
                // show new comment
                var output = res.output;
                
                console.log("toegevoegd"); 
                $(".allreactions").append(output);
                $("#message").val("");
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });
    }
    e.preventDefault();
});

// filter deadlines
$("#submitfilter").on("click", function(e){
    
    var projectId = $("#projects").val(); 
    console.log(projectId); 
    e.preventDefault();
});

