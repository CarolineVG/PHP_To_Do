/* dropdown filter */

$(document).ready(function () {
  $("#projects").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $(".dropdown-menu li").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});