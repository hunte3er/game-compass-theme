// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
jQuery(document).ready(function(){
	jQuery(document).foundation();

	// jQuery(".accordion dd").on("click", "a:eq(0)", function (event)
		  // {
			// css_object_open = {'-webkit-transform' : 'scaleY(1)'};
			// css_object_open['-ms-transform'] = 'scaleY(1)';
			// css_object_open['transform'] = 'scaleY(1)';
			// css_object_close = {'-webkit-transform' : 'scaleY(0)'};
			// css_object_close['-ms-transform'] = 'scaleY(0)';
			// css_object_close['transform'] = 'scaleY(0)';
			
			// var dd_parent = jQuery(this).parent();

			// if(dd_parent.hasClass('active')){
				// jQuery(".accordion dd div.content:visible").css(css_object_open);//slideToggle(700);
			// }
			// else
			// {
				// jQuery(".accordion dd div.content:visible").css(css_object_open);//.slideToggle(700);
				// jQuery(this).parent().find(".content").css(css_object_close);//.slideToggle(700);
			// }
		  // });
		  
	jQuery(".search-icon").on("click", function (event)
		{
			jQuery(this).addClass('bound');
			if(jQuery(".search-bar").hasClass('active')){
				jQuery(".search-bar").removeClass('active');
				jQuery(".search-bar").slideToggle(700);
				}
			else{
				jQuery(".search-bar").addClass('active');
				jQuery(".search-bar").slideToggle(700);
				}
		});
		
		
	var img_dimensions = new Array();
	jQuery('.gallery-slider').find('img').each(function(){
		img_dimensions.push(jQuery(this).height()/jQuery(this).width());
	});
	
	var report = {};

	jQuery.each(img_dimensions,function(i,el){
	  report[el] = report[el] + 1 || 1;
	});
	
	var to_use = Object.keys(report)[0];
	jQuery.each(report,function(key, value){
		if(parseFloat(value) > parseFloat(report[to_use])){
			to_use = parseFloat(key);
		}
	});
		
	var $slide = jQuery(".gallery-slide")
	$slide.css('max-height',$slide.width() * to_use);
	$slide.css('overflow', 'auto');
		
	jQuery('.gallery-slider').slick({
                cssEase			: 'ease-in-out',
				swipeToSlide	: true
            });
			
	jQuery(".tag-filter-body").mCustomScrollbar({
		theme:"inset"
	});
	
	// var slide-height = 99999;
	// jQuery(".slick-slide").each(function(){
		// if(var img-height = jQuery(this).find('img').height() < slide-height){
			// slide-height = img-height;
		// }
	// });
	
	jQuery(".slick-slide").mCustomScrollbar({
		theme:"inset"
	});
});
//}(jQuery));