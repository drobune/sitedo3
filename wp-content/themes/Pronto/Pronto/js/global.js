jQuery( function($) {
	
	// Scroll back to top	
	function WPEXBackTopScroll() {
		
		$( 'a[href=#top]' ).on('click', function() {
			$( 'html, body' ).animate({scrollTop:0}, 'normal');
			return false;
		} );
	
	}
	
	// Scroll to comments	
	function WPEXCommentScroll() {
		
		$( '.comment-scroll a' ).click( function(event) {		
			event.preventDefault();
			$( 'html,body' ).animate( {
				scrollTop: $( this.hash ).offset().top
				}, 'normal' );
		} );
		
	}
	
	// Responsive navbar
	function WPEXResponsiveNav() {
		var nav = $( '#site-navigation' ), button, menu;
		$( '.nav-toggle' ).on( 'click', function() {	
			$( '.nav-menu' ).toggleClass( 'toggled-on' );
			$( '.nav-toggle' ).find('.toggle-icon').toggleClass('icon-arrow-down icon-arrow-up');
		} );
	}
	
	//Toggle sidebar
	$('a#toggle-btn').click(function(){
		$('div#toggle-wrap').slideToggle();
		$(this).find('i').toggleClass('icon-reorder icon-remove');
	})
	
	// Masonry Widths
	function WPEXMasonry() {
		
		// Shit browsers
		if ($.browser.msie && parseInt($.browser.version, 10) === 8) {
			
			$('.grid').masonry({
					itemSelector: '.loop-entry',
					gutterWidth : 30,
					columnWidth: 240,
					isAnimated: false
			});
		
		// Decent browsers		
		} else {
		
			var $windowWidth = $(window).width();
			var $gridWidth = $('.grid').width();
				
			if ( $windowWidth > 959 && $windowWidth <= 1024) {
				var $colWidth = ( $('.container-right').width() - 40 ) / 3;
				 $('.grid').masonry({
					itemSelector: '.loop-entry',
					gutterWidth : 20,
					columnWidth: $colWidth,
					isAnimated: true
				});
				$('.loop-entry').width( $colWidth );
				
			} else if ( $windowWidth > 700 && $windowWidth <= 959) {
				var $colWidth = ( $windowWidth - 120 ) / 3;
				 $('.grid').masonry({
					itemSelector: '.loop-entry',
					gutterWidth : 20,
					columnWidth: $colWidth,
					isAnimated: true
				});
				$('.loop-entry').width( $colWidth );
				
				
			} else if ( $windowWidth > 400 && $windowWidth < 700 ) {
				var $colWidth = ( $windowWidth - 100 ) / 2;
				$('.grid').masonry({
					itemSelector: '.loop-entry',
					gutterWidth : 20,
					columnWidth: $colWidth,
					isAnimated: true
				});
				$('.loop-entry').width( $colWidth );
				
			} else {
				$('.grid').masonry({
					itemSelector: '.loop-entry',
					gutterWidth : 30,
					columnWidth: 240,
					isAnimated: true
				});
				$('.loop-entry').width(240);
			}
		}
	}
	
	
	$(document).ready(function(){
		WPEXBackTopScroll();
		WPEXCommentScroll();
		WPEXResponsiveNav();
		WPEXMasonry();
	});
	
	
	$(window).load(function(){
		WPEXMasonry();
	});
	
	
	$(window).resize(function() {
   		WPEXMasonry();
	});
	
	if (document.addEventListener){
		window.addEventListener("orientationchange", function() {
			WPEXMasonry();
		});
		
		window.addEventListener("resize", function() {
			WPEXMasonry();
		});
	}
	
	
});