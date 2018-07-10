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


/* show full task */
$(".media").click(function(){
    console.log("hallo"); 
    $(".comment-hidden").css("display", "block"); 
});

$(".close").click(function(){
    console.log("daag"); 
    $(".comment-hidden").css("display", "none"); 
});