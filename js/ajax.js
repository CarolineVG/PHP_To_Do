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
        var taskId = $("#check").attr('data-value');
        $.ajax({
            method: "POST",
            url: "ajax/checkTask.php",
            data: {taskId: taskId}
        })
        .done(function(res) { 
            if(res.status == "success") {
                // change status to DONE
                // get id from div status
                var showid = $('#id' + taskId).attr('id');
                $('#'+showid).html(res.output); 
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });

        //e.preventDefault();
    } else {
        // unchecked
        console.log("unchecked"); 

        var taskId = $("#check").attr('data-value');
        $.ajax({
            method: "POST",
            url: "ajax/uncheckTask.php",
            data: {taskId: taskId}
        })
        .done(function(res) { 
            if(res.status == "success") {
                // change status to TO DO
                console.log(res.output); 
                // get id from div status
                var showid = $('#id' + taskId).attr('id');
                $('#'+showid).html(res.output); 
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });
    }
});