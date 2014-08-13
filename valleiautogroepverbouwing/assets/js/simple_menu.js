/**
* hoverIntent r6 // 2011.02.26 // jQuery 1.5.1+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
* 
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne brian(at)cherne(dot)net
*/
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover)}})(jQuery);




(function($) {
	$.fn.simpleMenu = function() {
		this.removeClass("simple_menu_css");
		
		var olORul = this.get(0).tagName;
		
		if (this.hasClass("vertical")) {
			this.find("li").each(function () {
				
				if ($(this).children(olORul).length > 0) {
					$(this).children("a").append('<span class="r"></span>');
				}
				
				$(this).hoverIntent({
					timeout: 100,
					over: function () {
						if ($(this).children(olORul).length > 0) {
							$(this).children("a").addClass("selected");
							$(this).children(olORul).fadeIn("fast");;
						}
					},
					out: function () {
						$(this).children(olORul).hide();
						$(this).children("a").removeClass("selected");
					}
				});
			});
			
			
			
		} else {
			
			this.find("li").each(function () {
				
				if ($(this).children(olORul).length > 0) {
					if ($(this).parents(olORul).length > 1) {
						$(this).children("a").append('<span class="r"></span>');
					} else {
						$(this).children("a").append('<span class="b"></span>');
					}
				}
				
				
				$(this).hoverIntent({
					timeout: 100,
					over: function () {
						if ($(this).children(olORul).length > 0) {
							$(this).children("a").addClass("selected");
							$(this).children(olORul).fadeIn("fast");;
						}
					},
					out: function () {
						$(this).children(olORul).hide();
						$(this).children("a").removeClass("selected");
					}
				});
			});
			
			
		}
	};
})(jQuery);


// $(".simple_menu li").each(function () {

// <span class="r"></span>