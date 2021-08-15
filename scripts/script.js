$( document ).ready(function() {

 $(document).scroll(function(){

        if($(this).scrollTop() >= ($('html').offset().top + 100)) {
            $("html").addClass("fixed-logo");
          
        } else {

             $("html").removeClass("fixed-logo");
        }
    });

  var classes = [ 'circle', 'ellipse-small', 'ellipse-big' ]; // the classes you want to add
    $('.post-item').each(function(i) { // the element(s) you want to add the class to.
        $(this).addClass(classes[ Math.floor( Math.random()*classes.length ) ] );
		});

	// FILTER TOGGLE
	$('.filter-item').on('click', function (e) {
		e.preventDefault();
		var otherFilters = $(this).siblings();
		var currentFilter = $(this).data('filter');
		var selectedItem = $('.main-content').find('.' + currentFilter);
		var otherItems = $('.main-content > *').not(selectedItem);
		// Toggle the content
		if (selectedItem.hasClass('hide')) {
			// show the selected item
			selectedItem.removeClass('hide').addClass('show');
			// hide the other items
			otherItems.removeClass('show').addClass('hide');
		}

		// set active class on currentFilter
		$(this).addClass('active');
		// check if other filters have a active class
		if (otherFilters.hasClass('active')) {
			otherFilters.removeClass('active');
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
	var _el = $('.issue-content');
	var elColor = _el.css( "background-color" );
	console.log(elColor);
	console.log("test");

});
