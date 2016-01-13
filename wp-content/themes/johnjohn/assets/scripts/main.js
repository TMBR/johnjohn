
(function($) {

	'use strict';

	var SiteApp = {



		// Initialize the functions
		init: function() {

			SiteApp.Mobiledetect();
			SiteApp.Smoothscroll();
			SiteApp.Throttle();
			SiteApp.Preloader();
			SiteApp.Slider();
			SiteApp.Heroeffect();
			SiteApp.Spinimg();
			SiteApp.Lightbox();

			// Call this to show all animited items
			// SiteApp.ShowAnimated();
		},


		// Mobile Device Detection
		Mobiledetect: function() {

			var ismobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));

			if(ismobile == true){
				$('body').addClass('mobile');
			} else {
				$('body').addClass('no-touch');
			}

		},



		// Smooth Scroll to Anchor Tags
		Smoothscroll: function() {

			$('a[href*=#]:not([href=#])').on('click','', function( e ) {
				e.preventDefault();

				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

					if (target.length) {
						$('html,body').animate(
							{ scrollTop: target.offset().top },
							{ duration: 600, easing:'easeOutCubic'}
						);
						return false;
					}

				}

			});
		},



		// Window Scroll Functions
		Throttle: function() {

			var throttleTimeOut = 50; //milliseconds before triggering function again

			// Window Scroll functions
			$(window).on('scroll', _throttle(function(){
				/* do your normal scroll stuff here, but it'll be
				 * more-reasonably controlled, so as to not peg
				 * the host machine's processor */
			}, throttleTimeOut));

			// Window Resize Functions
			$(window).on('resize', _throttle(function(){
				/* do your normal resize stuff here, but it'll be
				 * more-reasonably controlled, so as to not peg
				 * the host machine's processor */
			}, throttleTimeOut));

		},


		// Page Loading Progress
		Preloader: function() {

			$(window).load(function() {
				$('#preloader .spinner').delay(100).fadeOut(300, function() {
					$('.body').animate({
						opacity: 1
					}, 300).addClass('ready');
					$(this).parent().delay(300).fadeOut(500, function() {
						SiteApp.Animated();
					});
				});
			});

		},


		// Slider
		Slider: function() {

			$(document).ready(function() {

				 $('.flexslider').flexslider({
			    animation: "slide",
			    slideshow: true, // auto play on load
			    slideshowSpeed: 4000,
					animationSpeed: 600,
					pauseOnHover: true,
					controlNav: true, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
					directionNav: false

			  });
			});

		},



		// Lightbox Gallery
		Lightbox: function() {

			//$('.imagepop').magnificPopup({type:'image'});

			$('.js-popupvideo').magnificPopup({
				type: 'iframe',
				removalDelay: 300,
				mainClass: 'mfp-fade'
			});
		},


		// Hero Animation
		Heroeffect: function() {

			var body = $('body');
			var play = $('#hero-play');

			var herovid = $('#herovid');
			var vidsrc = $('#herovid').attr('data-src');
			var autoplay = '?feature=oembed&autoplay=1';
			var autopause = '?feature=oembed&autoplay=0';
			var vidplay = vidsrc.concat(autoplay);
			var vidpause = vidsrc.concat(autopause);


			play.on('click', function(event){
				event.preventDefault();
				if(body.hasClass('vid-reveal')) {
					body.removeClass('vid-reveal').addClass('vid-revealed');
					herovid.attr('src',vidpause);
				} else {
					body.addClass('vid-reveal');
					herovid.attr('src',vidplay);
					if(body.hasClass('vid-revealed'))	{
						body.removeClass('vid-revealed');
					}
				}
			});

		},

		Spinimg: function() {

			var rangeSlider = document.getElementById('slider-range');

			noUiSlider.create(rangeSlider, {
				start: [12],
				range: {
					'min': [1],
					'max': [24]
				}
			});

			rangeSlider.noUiSlider.on('update',function( values, handle ){
				var imgid = '/wp-content/themes/johnjohn/public/images/spin/img' + Math.floor(values[handle]) + '.jpg';

				$('#spin-img').attr('src',imgid);
			});

		},


		// Animation Effects
		Animated: function() {

			$('.animation, .animation-visible').each(function() {

				var $element = $(this);

				$element.waypoint(function() {

					var delay = 0;

					if ($element.attr('data-delay')) delay = parseInt($element.attr('data-delay'), 0);
					if (!$element.hasClass('animated')) {
						setTimeout(function() {
							$element.addClass('animated ' + $element.attr('data-animation'));
						}, delay);
					}
					delay = 0;
				}, {
					offset: '70%'
				});

			});

		},



		// Show All Animated Items
		ShowAnimated: function() {

			$('.animation, .animation-visible').each(function() {
				$(this).addClass('animated');
			});

		}



	};



	// Run the Main Function
	$(function() {
		SiteApp.init();
	});



})(window.jQuery);