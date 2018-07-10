/** expand task */
/*var click = document.querySelector(".media");

click.addEventListener("click", function(){
    console.log("hallo"); 
    document.querySelector(".comment-hidden").style.display = "block"; 

});*/


$(".media").click(function(){
    console.log("hallo"); 
    $(".comment-hidden").css("display", "block"); 
});

$(".close").click(function(){
    console.log("daag"); 
    $(".comment-hidden").css("display", "none"); 
});