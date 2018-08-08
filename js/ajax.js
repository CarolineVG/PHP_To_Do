
    $(document).ready(function(){
        $("#submitcomment").click(function(){
            //event.preventDefault();

            console.log("clicked"); 
            $.post("taskDetail.php", function(data){
                $("#result").html(data); 
            });
        });
    });
