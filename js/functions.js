/* show full task */
$(".media").click(function(){
    /*console.log("hallo"); 
    // source: https://stackoverflow.com/questions/25148939/triggering-click-function-only-on-specific-element 
    $(this).siblings("div").toggle();*/

    

});

/* collapse oroject */
$(".d-block").on("click", function(e){ 
    console.log("hi"); 
    e.preventDefault(); 
});



/* dropdown filter */

$(document).ready(function(){
    $("#projects").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      console.log(value); 
      $(".dropdown-menu li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });