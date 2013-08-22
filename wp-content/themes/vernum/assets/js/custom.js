;(function($) {


/*------------------------------------*/
/*	jQuery Document Ready Functions
/*------------------------------------*/
$(document).ready(function() {
if ($.fn.cssOriginal != undefined) {
	$.fn.css = $.fn.cssOriginal;
}

/* Parallax */
$('.parallax').each(function(index, obj) {
	var $this = $(this),
		$parent = $this.closest('.container').parent();

	$this.removeClass('parallax');
	$parent.css('backgroundImage', 'url(' + $this.data('bg') + ')');
	$parent.addClass('parallax');
	$parent.parallax('50%', $this.data('speed'));

});

	
/* Testimonials Rotator */
$('.testimonials ul li').quovolver();
	
/* Skill Bars */
	setTimeout(function(){

		$('.skill-bar .skill-bar-content').each(function() {
			var me = $(this);
			var perc = me.attr("data-percentage");

			var current_perc = 0;

			var progress = setInterval(function() {
				if (current_perc>=perc) {
					clearInterval(progress);
				} else {
					current_perc +=1;
					me.css('width', (current_perc)+'%');
				}

				me.text((current_perc)+'%');

			}, 10);

		});

	},10);

});

/*---------------------------------*/
/*	jQuery Window Load Functions
/*---------------------------------*/

/* Sticky Navigation Menu */
$(window).load(function() {
	$("header").sticky({ topSpacing: 0 });
});

/* One Page Scrolling */
$(window).load(function() {
	$('.scrolling').onePageNav({
		currentClass: 'current',
		changeHash: true,
		filter: ':not(.external)',
		scrollOffset: 40
	});
	
});

/* Isotope Portfolio */
$(window).load(function() {

	var $container = $('#portfolio-container');

	$container.isotope({
		itemSelector: '.item',
		layoutMode: 'masonry'
	});

	var $optionSets = $('.option-set'),
			$optionLinks = $optionSets.find('li');

	$optionLinks.click(function() {
		var $this = $(this);
		// don't proceed if already selected
		if ($this.hasClass('selected')) {
			return false;
		}
		var $optionSet = $this.parents('.option-set');
		$optionSet.find('.selected').removeClass('selected');
		$this.addClass('selected');
	});

	$('#filters').on('click', 'a', function() {
		var selector = $(this).data('filter');
		$container.isotope({filter: selector});

	});

});


/* Lightbox */
jQuery(function($) {
	$(".swipebox").swipebox();
});


/* Custom Select Menu in Contact Form */
$( function() {
	
	$( '#cd-dropdown' ).dropdown( {
		gutter : 0
	} );

});



/*----------------------------------------------------*/
/*	Responsive Menu
/*----------------------------------------------------*/
var jPanelMenu = {};
$(function() {
	$('pre').each(function(i, e) {hljs.highlightBlock(e)});
	
	jPanelMenu = $.jPanelMenu({
		menu: 'nav.menu ul',
		animated: false,
		closeOnContentClick: false,
		before: function(){ },
		beforeOpen: function(){
			$.fn.hasCss = function(prop, val) {
				return $(this).css(prop.toLowerCase()) == val.toLowerCase();
			}
			var sticky = $('header.top');
			if ((sticky).hasCss('position','fixed')){
				(sticky).css('left','250px');
			}
			console.log($('header.top').css('position'))
			if (!(sticky).hasCss('position','fixed')){
				(sticky).css('left','0px');
			}
			$(window).scroll(function(){
				$.fn.hasCss = function(prop, val) {
					return $(this).css(prop.toLowerCase()) == val.toLowerCase();
				}
				var sticky = $('header.top');
				if ((sticky).hasCss('position','fixed')){
					(sticky).css('left','250px');
				}
			});
		},
		beforeClose: function(){ 
			$.fn.hasCss = function(prop, val) {
				return $(this).css(prop.toLowerCase()) == val.toLowerCase();
			}
			var sticky = $('header.top');
			if ((sticky).hasCss("position", "fixed")){
				 (sticky).css('left','0px');
			} 
			if (!(sticky).hasCss('position','fixed')){
				(sticky).css('left','0px');
			}
			$(window).scroll(function(){
				$.fn.hasCss = function(prop, val) {
					return $(this).css(prop.toLowerCase()) == val.toLowerCase();
				}
				var sticky = $('header.top');
				if ((sticky).hasCss('position','fixed')){
					(sticky).css('left','0px');
				}
			});
		}
	});
	jPanelMenu.on();

	$(document).on('click',jPanelMenu.menu + ' li a',function(e){
		if ( jPanelMenu.isOpen() && $(e.target).attr('href').substring(0,1) == '#' ) { jPanelMenu.close(); }
	});

	$(document).on('click','#trigger-off',function(e){
		jPanelMenu.off();
		$('html').css('padding-top','40px');
		$('#trigger-on').remove();
		$('body').append('<a href="" title="Re-Enable jPanelMenu" id="trigger-on">Re-Enable jPanelMenu</a>');
		e.preventDefault();
	});

	$(document).on('click','#trigger-on',function(e){
		jPanelMenu.on();
		$('html').css('padding-top',0);
		$('#trigger-on').remove();
		e.preventDefault();
	});

});


})(jQuery);