
/* new project */
$(".btnSaveNewProject").on("click", function(e){
    e.preventDefault(); 
    console.log("make new project - ajax"); 

    var title = $("#projectname").val(); 
    console.log(title); 

    $.ajax({
        type: "POST",
        url: "./newProject.php",
        data: {title: title},

    }).done(function(result){
        console.log("ok"); 
        location.reload(); 
    }).fail(function(error){
        console.log("nope");
        console.log(error);  
    });

});


/* show full task */
$(".media").click(function(){
    console.log("hallo"); 
    // source: https://stackoverflow.com/questions/25148939/triggering-click-function-only-on-specific-element 
    $(this).siblings("div").toggle();
});