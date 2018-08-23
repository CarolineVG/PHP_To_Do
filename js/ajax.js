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

                //console.log("toegevoegd"); 

                $(".allreactions").append(output).hide().fadeIn(1000);
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

                //console.log(output); 
                 
                $(".projectDropdown").append(output);
                $(".media-filter").hide().fadeIn(1000);
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });
    //}
    e.preventDefault();
});

// task checked
$('.check').on('click',function (e) {

    console.log('ok'); 
    if ($((this)).is(':checked')) {
        // checked
        var taskId = $(this).attr('data-value');
        $.ajax({
            method: "POST",
            url: "ajax/checkTask.php",
            data: {taskId: taskId}
        })
        .done(function(res) { 
            if(res.status == "success") {
                // change status to DONE
                // change color to green
                var showid = $('#id' + taskId).attr('id');
                $('#'+showid).html(res.output); 
                $('#'+showid).addClass("green").hide().fadeIn(1000);
                // set checkbox on checked
                $(this).prop('checked', true); 
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });
    } else {
        // unchecked
        console.log("unchecked"); 

        var taskId = $(this).attr('data-value');
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
                console.log(showid); 
                $('#'+showid).html(res.output); 
                $('#'+showid).removeClass("green");
                $('#'+showid).addClass("orange").hide().fadeIn(1000);;
            } 
        })
        .fail(function(err){
            console.log(err.status); 
        });
    }
});