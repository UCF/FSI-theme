var Generic = {};

Generic.resizeSearch = function($){
	var form          = $('.search-form');
	var height        = form.height();
	var search_field  = form.find('.search-field');
	var search_button = form.find('.search-submit');
	
	var loops = 0;
	
	while (form.height() == height){
		var width = search_field.width();
		search_field.width(++width);
		
		loops++;
		if (loops > 1024){break;}
	}
	search_field.width(search_field.width() + search_button.width() - 1);
};

Generic.homeDimensions = function($){
	var cls = this;
	cls.home_element = $('#home');
	
	cls.resizeToHeight = function(element, target_height){
		if(element.length < 1){return;}
		
		var loops = 0;
		
		var difference = function(){
			return Math.abs(element.height() - target_height);
		};
		
		// Adjust smaller if the text is too large
		while (element.height() > target_height){
			var current_font_size = parseInt(element.css('font-size'));
			element.css('font-size', --current_font_size + 'px');
			if (current_font_size < 10){
				break;
			}
			if (++loops > 1024){break;}
		}
		
		
		// Adjust larger if the text is too small
		while (element.height() < target_height && difference() > 8){
			var current_font_size = parseInt(element.css('font-size'));
			element.css('font-size', ++current_font_size + 'px');
			if (element.height() > target_height && difference() > 8){
				element.css('font-size', --current_font_size + 'px');
				break;
			}
			if (++loops > 1024){break;}
			console.log(element.height(), target_height, current_font_size);
		}
		
		element.height(target_height);
	};
	
	cls.uniformHeight = function(){
		var template = cls.home_element.data()['template'];
		
		if (template == "home-nodescription"){
			cls.resizeToHeight($('.content'), $('.site-image').height());
		}
		
		if (template == "home-description"){
			cls.resizeToHeight($('.right-column .description'), $('.site-image').height() - $('.search').height());
		}
		return;
	};
	
	if (cls.home_element.length < 1){return;}
	
	cls.uniformHeight();
	
};

/* Remove empty table cells and remove the class 
'table-bordered' for tablets/phones.  (For Personnel output)
 */
Generic.mobileTables = function($) {
	if ($(window).width() <= 767) {
		$('.table.table-bordered').removeClass('table-bordered');
	}
	else {
		$('.people-org-group .table').addClass('table-bordered');
	}
}

/**
 * Get the body column's height to equal that of the body tag at desktop size.
**/
Generic.fullHeightCol = function($) {
	if ( $(window).width() > 767) {
		$('div#rightcol-content').css('min-height', ($('body').height()));
	}
}

/* Fix images with aligncenter class so that they actually center when wrapped in a <p> tag.
 * Will only fix images who are the only child element of a given <p> tag to prevent 
 * undesired results in <p> tags with both images and text content.
 *
*/
Generic.aligncenterFix = function($) {
	if ( $('img.aligncenter').parent('p').children().length < 2 ) {
		$('img.aligncenter').parent('p').css('text-align','center');
	}
}

if (typeof jQuery != 'undefined'){
	jQuery(document).ready(function($) {
		Webcom.slideshow($);
		Webcom.chartbeat($);
		Webcom.analytics($);
		Webcom.handleExternalLinks($);
		Webcom.loadMoreSearchResults($);
		
		/* Theme Specific Code Here */
		//Generic.homeDimensions($);
		//Generic.resizeSearch($);
		Generic.mobileTables($);	
		Generic.aligncenterFix($);		
		Generic.fullHeightCol($);
		
		$(window).resize(function() {
			Generic.mobileTables($);	
			Generic.aligncenterFix($);		
			Generic.fullHeightCol($);
		});
		
	});
}else{console.log('jQuery dependancy failed to load');}