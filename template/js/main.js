$(function() {
   
	/**
	 * Content slider setup
	 */
	$("#content_slider").DDSlider({
	    nextSlide: ".slider_arrow_right",
	    prevSlide: ".slider_arrow_left",
	    selector:  ".slider_selector"
	});
	
	/**
	 * Tooltip
	 */
	$(".tooltip_enabled").hover(function() {
		$(this).prepend('<span class="tooltip">' + $(this).parent().find("a").attr("title") + '<span class="arrow"></span></span>');
		$(this).find(".tooltip").stop().fadeIn();
	}, function() {
		$(this).find(".tooltip").hide();
		$(".tooltip").remove();
	});

	$(".tooltip_enabled").mousemove(function(e) {
		$(".tooltip").css({ left:e.pageX - ($(".tooltip").width() / 2) - 4, top:e.pageY - 10 });
	});	
    
});