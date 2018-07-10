/** expand task */
/*var click = document.querySelector(".media");

click.addEventListener("click", function(){
    console.log("hallo"); 
    document.querySelector(".comment-hidden").style.display = "block"; 

});*/

/* delete project */
$(".fa-trash-alt").on("click", function(e){
    e.preventDefault();

    // which project to delete? -> check id
    var idToDelete = this.id; 
    console.log(idToDelete); 
});

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
        //location.reload(); 
    }).fail(function(error){
        console.log("nope");
        console.log(error);  
    });

});


/* show full task */
$(".media").click(function(){
    console.log("hallo"); 
    $(".comment-hidden").css("display", "block"); 
});

$(".close").click(function(){
    console.log("daag"); 
    $(".comment-hidden").css("display", "none"); 
});