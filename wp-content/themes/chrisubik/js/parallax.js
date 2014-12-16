jQuery(function( $ ){

	// Enable parallax and fade effects on homepage sections
	$(window).scroll(function(){

		scrolltop = $(window).scrollTop()
		scrollwindow = scrolltop + $(window).height();

		$(".parallax-section.below-header").css("backgroundPosition", "20%" + -(scrolltop/6) + "px");

	});

});
