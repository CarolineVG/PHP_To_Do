$("#submitcomment").on("click", function(e){
    var comment = $("#message").val();
    console.log(comment); 
    e.preventDefault();
});