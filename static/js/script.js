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
'table-bordered' for tablets/phones.
Note that Modernizr will not detect changes in browser 
window size after its initial state is checked, so
you'll have to refresh a desktop browser after resizing
to see the desired effect (if you're testing on a 
desktop.)
 */
Generic.mobileTables = function($) {
	if (Modernizr.mq("only all and (max-width: 767px)")) {
		/* Target empty ul's, primarily to remove empty lists written in Personnel lists */
		$('td ul').filter(function() { return $.trim($(this).html()) === '' }).parent('td').remove();
		$('tr td').filter(function() { return $.trim($(this).html()) === '' }).remove();
		/* Remove the class table-bordered for mobile, since it has undesirable results otherwise */
		$('.table-bordered').removeClass('table-bordered');
	}
}

/**
 * Get the body column's height to equal that of the body tag at desktop size.
 * Here we check for browsers with media query support and tablet/phone-sized browsers,
 * AND we also check for browsers that do not support media queries (IE 7, 8, for instance.) 
**/
Generic.fullHeightCol = function($) {
	if ( (Modernizr.mq("only all and (min-width: 767px)")) || (Modernizr.mq('only all') === false) ) {
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
	});
}else{console.log('jQuery dependancy failed to load');}