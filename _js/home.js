var home_tour = 0;

close_tour = function() {
	if (home_tour == 0) {
		$.fancybox.close();
	}
}

$(document).ready(function() {
	
	var total_links = $('#user .slides .link').size();
	var x = 2;
	$('#user .slides .link').each(function() {
		if (x > total_links) {
			x = 1;
		}
		$(this).attr('href', '#' + x);
		x++;
	});
	
	$("#user .slides").slides({
		generatePagination: true,
		preload: false,
		hoverPause: true,
		play: 6000,
	    pause: 2500
	});
	
	$('#user .video_home').fancybox({
		type: 'iframe'
		,href: 'http://www.youtube.com/v/Jh-j36hsb34'
		,width: 850
		,height: 510
	});
	
	if ($('#tour')[0]) {

		$.fancybox({
			href: '#tour'
			,type: 'inline'
			,width: 860
			,height: 400
			,closeClick: false
			,autoSize: false
			,scrolling: 'no'
			,padding:10
			,afterLoad: function() {
				$("#tour_slides").slides({
					generatePagination: true,
					preload: false,
					hoverPause: false,
					play: 10000,
					pause: 2000,
					animationComplete: function(current) {
						if (current == $('#tour_slides a').size()) {
							window.setTimeout("close_tour()", 7000);
						}
					}
				});
			}
		});

		$('#tour_slides a').live('mousedown', function() {
			home_tour = 1;
		});
		
		$('#show_tour').click(function() {
			$.ajax({
				type: 'POST'
				,url: PATH_PAINEL+'/_ajax/showTour.php'
				,data: { 'check' : $('#show_tour').attr('checked') }
				,dataType: 'json'
			});			
		});
	}

});