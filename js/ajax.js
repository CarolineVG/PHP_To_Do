$("#submitcomment").on("click", function(e){
    var comment = $("#message").val();

    $.ajax({
        method: "POST",
        url: "ajax/addComment.php",
        data: { comment: comment}
   })
   .done(function(res) { 
   
       if(res.status == "success") {
           // show new comment
           var output = res.comment;
           
           console.log(output); 
           $(".reactions").append(output);
           $("#message").val("");
       } 
   })
   .fail(function(err){
    console.log(res.status); 
   });

    e.preventDefault();
});

/*
                        <img src="' . $r['picture'] . '" alt="'. $r['picture'] .'">
                        <div class="media-body">
                            <h5>'.$r['username'].'</h5>
                            <p class="comment">' . $result['reaction'] . '</p>
                        </div>*/