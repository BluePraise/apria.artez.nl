$( document ).ready(function() {
	$(document).scroll(function(){
		// console.log('test');
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
			$(this).delay(0 * i).fadeIn(250);
		});
	}
	addRandomHeight();

	function resetGrid() {
		// var classes = [ 'circle', 'ellipse-small', 'ellipse-big' ]; // the classes you want to add
		$('.post-item').each(function(i) { // the element(s) you want to add the class to.
			$(this).css("left", 0);
			$(this).css("top", 0);
		});
	}
	var home_grid;
 	home_grid = $('.default-view').masonry({
		// options
		itemSelector: '.post-item',
		columnWidth: '.grid-sizer',
		gutter: 16,
		percentPosition: true,
		isFitWidth: true
	});

	setTimeout( function() { home_grid.masonry('layout'); }, 50);

	var filter_grid = " ";

	filter_grid = $('ul.grid-view').masonry({
		itemSelector: '.post-item',
		columnWidth: '.grid-sizer',
		gutter: 16,
		percentPosition: true,
		isFitWidth: true,
	});

	// FILTER TOGGLE
	$('.filter-item').on('click', function (e) {
		e.preventDefault();

		var otherFilters = $(this).siblings();
		var currentFilter = $(this).data('filter');
		var selectedItem = $('.home').find('.' + currentFilter);
		var otherItems = $('.main-content > *').not(selectedItem);
		var andTheseItems = $('.filter-paragraphs > *').not(selectedItem);

		if($(this).hasClass("active")) {
			selectedItem.removeClass('show').addClass('hide');
			$(this).removeClass('active');
			$('.default-view').removeClass("hide");
			setTimeout(function(){ home_grid.masonry('layout'); }, 100);
			return false;
		}

		// Toggle the content
		if (selectedItem.hasClass('hide')) {
			// show the selected item
			selectedItem.removeClass('hide').addClass('show');
			resetGrid();
			setTimeout(function() {filter_grid.masonry('layout'); } , 50)
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

	$('.msnry-view').masonry({
	// options
		itemSelector: '.grid-item',
		gutter: 20,
		percentPosition: true,
		// isFitWidth: true,
		resize: false,
		// columnWidth: '.grid-sizer'

	});
	// Sets the height for the iframe for youtube so it fits better
	var iframeEl = $("iframe");
	var iframeElYT = $("iframe[src*='youtube']");

	if (iframeEl = iframeElYT ) {
		iframeElYT.parent().css('height', '500px');
	}
	if (iframeEl != iframeElYT) {
		iframeEl.css('margin-left', '-14.5%');
	}

	// Sets position of searchbar in header
	// Finds the last menu item (which is searchbutton in nav)
	var _element = $('.main-navigation .menu-item').last();
	var cloneSearch = $('.search-field').clone().addClass('positionable');
	cloneSearch.insertAfter(_element);
	// get the offset for this element
	// find the left position + margin-left + 2px for the border.
	var _elLeft = _element.position().left + 18;
	//find the right position of this element
	// _elposition - width of the element
	var _elWidth = _element.width();
	var _elRight = _elLeft + _elWidth;
	var _searchbarWidth = $('.positionable').width();
	var _desiredPos = _elRight - _searchbarWidth;

	$('.positionable').css('left', _desiredPos);

	// on click show the search bar input.
	_element.on('click', function(e) {
		e.preventDefault();
		$('.positionable').toggleClass('hide show');
		console.log('hit 1');
		if ($("html").hasClass("fixed-logo") && $('.positionable').hasClass('show')) {
			console.log('hit 2');
			$('header.main-header').css("height", "128px");
		}
		else if ($("html").hasClass("fixed-logo") && $('.positionable').hasClass('hide')) {
			console.log('hit 3');
			$('header.main-header').css("height", "81px");
		}
		if ($(document).scroll() && $('.positionable').hasClass('show')) {
			console.log('hit 4');
			$('header.main-header').css("height", "128px");
		}
		else if ($(document).scroll() && $('.positionable').hasClass('hide')) {
			console.log('hit 5');
			$('header.main-header').css("height", "81px");
		}
	});
});
