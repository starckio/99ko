$(document).ready(function () {

	$(".msg").delay(3000).fadeOut('slow');

	$('#param_link').click(function(){
	    $(this).toggleClass('active');
	    $('#param_panel').toggleClass('active');
	});

});