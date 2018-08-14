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

    // delete previous filter
    $(".media-filter").remove(); 
    
    var projectId = $("#projects").val(); 
    console.log(projectId); 

    //if (val != 0){
        $.ajax({
            method: "POST",
            url: "ajax/filterDeadlines.php",
            data: {projectId: projectId}
        })
        .done(function(res) { 
            if(res.status == "success") {
                // show tasks from project
                console.log("success"); 
                var output = res.output;

                console.log(output); 
                 
                $(".projectDropdown").append(output);
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });
    //}
    e.preventDefault();
});

// task checked
$('#check').on('click',function (e) {
    if ($('#check').is(':checked')) {
        // checked
        console.log("checked"); 

        var checked = $("#check").val(); 
        console.log(checked); 
        e.preventDefault();
    } else {
        // unchecked
        console.log("unchecked"); 
    }
});