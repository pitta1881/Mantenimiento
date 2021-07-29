(function ($) {

	"use strict";

	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});


	$(".menuPadre").hover(function () {
		$(this).children('ul').collapse('show');
	}, function () {
		$(this).children('ul').collapse('hide');
	});

	$('.menuPadre').children('a').on('click', function (e) {
		e.stopPropagation();
	});


})(jQuery);