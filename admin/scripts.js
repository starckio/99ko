$(document).ready(function () {
<<<<<<< HEAD
	$('.tabs').each(function(){
		var $active, $content, $links = $(this).find('a');
		$active = $($links.filter('[href="'+localStorage['activeTab']+'"]')[0] || $links[0]);
		$active.addClass('active');
		$content = $($active.attr('href'));
		$links.not($active).each(function () {
			$($(this).attr('href')).hide();
		});
		$(this).on('click', 'a', function(e){
			$active.removeClass('active');
			$content.hide();
			$active = $(this);
			$content = $($(this).attr('href'));
			localStorage['activeTab'] = $(this).attr('href');
			$active.addClass('active');
			$content.show();
			e.preventDefault();
		});
	});
	$("#alert .alert-box").delay(5000).fadeOut('slow');
	// tri menu
	var elem = $('#navigation').find('li').sort(sortMe);
	function sortMe(a, b){
			return a.className > b.className;
	}
	$('#navigation').append(elem);
	// login
	$('#login input.alert').click(function(){
		document.location.href= $(this).attr('rel');
	});
=======
	$(".msg").delay(5000).fadeOut('slow');
	// tri menu
	var elem = $('#navigation').find('li').sort(sortMe);
	function sortMe(a, b){
			return a.className > b.className;
	}
	$('#navigation').append(elem);
	// login
	$('#login input.alert').click(function(){
		document.location.href= $(this).attr('rel');
	});
	// nav
	$('#open_nav').click(function(){
		if($('#sidebar').css('display') == 'none'){
			$('#sidebar').fadeIn();
		}
		else{
			$('#sidebar').hide();
		}
	});
	// param
	$('#param_link').click(function(){
		if($('#param_panel').css('display') == 'none'){
			$('#param_panel').slideDown();
		}
		else{
			$('#param_panel').slideUp();
		}
	});
>>>>>>> dev
});