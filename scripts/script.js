$( document ).ready(function() {
	$(document).scroll(function(){
		console.log('test');
		if($(this).scrollTop() >= ($('html').offset().top + 100)) {
			$("html").addClass("fixed-logo");
		} else {

				$("html").removeClass("fixed-logo");
		}
	});
	function addRandomHeight() {
		// var classes = [ 'circle', 'ellipse-small', 'ellipse-big' ]; // the classes you want to add
		$('.post-item').each(function(i) { // the element(s) you want to add the class to.
			//    $(this).addClass(classes[ Math.floor( Math.random()*classes.length ) ] );
			// add a random height bewteen 700px and 385px
			min = Math.ceil(385);
			max = Math.floor(700);
			var h = Math.floor(Math.random() * (max - min + 1) + min);
			$(this).css("height", h);
			$(this).delay(150 * i).fadeIn(250);
		});
    	
	}
	addRandomHeight();
	
	$('.home-grid').on( 'load', function() {
		
		$('.home-grid').masonry({
			// options
			itemSelector: '.post-item',
			columnWidth: '.grid-sizer',
			gutter: 16,
			percentPosition: true,
			horizontalOrder: true
		});
	});
	// function loadMasonryonHome() {
	// }


	// FILTER TOGGLE
	$('.filter-item').on('click', function (e) {
		e.preventDefault();
		var otherFilters = $(this).siblings();
		var currentFilter = $(this).data('filter');
		var selectedItem = $('.home').find('.' + currentFilter);
		var otherItems = $('.main-content > *').not(selectedItem);
		var andTheseItems = $('.filter-paragraphs > *').not(selectedItem);
		// Toggle the content
		if (selectedItem.hasClass('hide')) {
			// show the selected item
			selectedItem.removeClass('hide').addClass('show');
			// hide the other items
			otherItems.removeClass('show').addClass('hide');
			andTheseItems.removeClass('show').addClass('hide');
		}

		// set active class on currentFilter
		$(this).addClass('active');
		// check if other filters have a active class
		if (otherFilters.hasClass('active')) {
			otherFilters.removeClass('active');
			andTheseItems.removeClass('active');
		}
	});

	$('.search-results').masonry({
	// options
		itemSelector: '.search-result',
		columnWidth: 200,
		gutter: 20,
		percentPosition: true,
		columnWidth: '.grid-sizer'
	});

});
