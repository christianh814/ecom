$(document).ready(function(){

$('#demo').hover(
  function () {
    $(this).toggle();

 
});

// Below is targeting a css class "image_container"
$(".image_container").click(function(){
	var user_input;
	return user_input =  confirm("Delete this slide? (This action cannot be undone)");
});


});
