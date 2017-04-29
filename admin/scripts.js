$(document).ready(function () {
	$(".msg").delay(5000).fadeOut('slow');
	// tri menu
	var elem = $('#navigation').find('li').sort(sortMe);
	function sortMe(a, b){
			return a.className > b.className;
	}
	$('#navigation').append(elem);
	// param
	$('#param_link').click(function(){
		if($('#param_panel').css('display') == 'none'){
			$('#param_panel').slideDown();
		}
		else{
			$('#param_panel').slideUp();
		}
	});
});