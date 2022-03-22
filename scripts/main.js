var $=jQuery.noConflict();
// Detect touch device
var $ = jQuery.noConflict();
var isTouch = 'ontouchstart' in document,
	noTouch = !isTouch;

var duration = 250;

function getBreakpoint() {
	if (!$("#bp").length) {
		$('<div id="bp"/>').appendTo('body');
	}

	var width = $('#bp').width();

	if (width == 3) {
		return 'desktop';
	} else if (width == 2) {
		return 'tablet';
	} else if (width == 1) {
		return 'mobile';
	}
}

function positionColumnLabel(scope, bodyWidth) {
	if ($('.column-label').length) {
		if (scope) {
			var label = scope.find('.column-label');
		} else {
			var label = $('.column-label');
		}
		if (!bodyWidth) {
			var bodyWidth = $('body').width();
		}
		label.css('left', bodyWidth - label.closest('.sidebar-column').outerWidth(true) - label.width() / 2 + "px");
	}
}

function affixHeight() {

	if (getBreakpoint() != 'mobile') {
		var main = $('article.main-column .content-wrap'),
			scroller = $('.js-affix-scrolling'),
			container = $('.affix-placeholder');

		if (main.height() < scroller.height()) {
			railHeight = scroller.height();
		} else {
			railHeight = main.height();
		}

		container.css('height', railHeight);
	}
}

function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
};

function filter() {

	var filters = [];

	$(this).toggleClass("checked");

	$(".js-filter:checked").each(function () {
		var filterValue = $(this).val(),
			filterGroup = $(this).data("type");

		if (!(filterGroup in filters)) {
			filters[filterGroup] = [];
		}

		filters[filterGroup].push(".search-result.filter-" + filterGroup + "-" + filterValue);
	});

	// Build filter expression
	for (var i in filters) {
		filters[i] = filters[i].join(",");
	}

	$('div.search-results').empty();
	$('div.search-results').append('<div class="grid-sizer" id="grid-sizer"></div>');
	$('.search-results-hidden .search-result').removeClass('cloned');

	if ($(".js-filter:checked").length == 0) {
		$('.search-results-hidden').find('.search-result').clone().appendTo($('div.search-results'));

	}

	$(".search-results-hidden .search-result").filter(function () {
		var el = $(this),
			matches = true;

		for (var i in filters) {
			var filtersByGroup = filters[i];

			if (el.is(filtersByGroup) && !el.hasClass('cloned')) {
				el.clone().appendTo($('div.search-results'));
				el.addClass('cloned');
			}
		}

	});
}

function captionWidth() {
	$('.inline-image').each(function () {
		var item = $(this),
			image = item.find('img'),
			caption = item.find('figcaption');

		if (caption.length) {
			caption.css('width', image.width());
		}
	});
}
captionWidth();

function closeOverlayer() {
	$('#overlay-content').fadeOut(duration);

	setTimeout(function () {
		$('html').removeClass('no-scroll overlay-open');
		$('#overlay-content').remove();
	}, duration);
}

$(function () {
	$('html').addClass(isTouch ? 'is-touch' : 'no-touch');

	FastClick.attach(document.body);

	// Balance text and headlines
	balanceText();

	// Place column label correctly.
	$(window)
		.on('resize', function () {
			if (getBreakpoint() != 'mobile') {
				positionColumnLabel();
			}

			captionWidth();

			affixHeight();

		}).trigger('resize');

	// Picture text toogle
	$(document)
		.on('click', '.js-picture-text-toggle', function () {
			if ($('html').hasClass('text-view')) {
				$('html').removeClass('text-view').addClass('picture-view');
				$.cookie('displayMode', 'picture', { path: '/' });
			} else {
				$('html').removeClass('picture-view').addClass('text-view');
				$.cookie('displayMode', 'text', { path: '/' });
			}
		});

	// Footnotes
	$(document)
		.on('click', '.js-footnote-up', function () {
			var el = $(this),
				note = $('[data-footnoteanchor="' + el.data('footnotetext') + '"]');

			if (note.length) {
				$('html, body').animate({
					scrollTop: note.offset().top - 150,
				}, 500);
			}
			$('.footnote').removeClass('footnote-highlight');
		}).on('click', '.js-footnote', function () {
			var el = $(this),
				note = $('[data-footnotetext="' + el.data('footnoteanchor') + '"]').closest('.footnote');

			if (note.length) {
				console.log($('.article__footnotes details'));
				$('.article__footnotes details').attr("open", "");
				position = note.offset().top - 100;

				$('html, body').animate({
					scrollTop: position,
				}, 500);

				note.siblings('.footnote').removeClass('footnote-highlight');
				note.addClass('footnote-highlight');
			}
		});

	// Overlay for issue, newsletter subscrube
	$(document)
		.on('click', '.js-open-as-overlay', function (e) {
			if ($(e.target).is("a")) {
				var url = $(this).attr("href");
			} else if ($(this).closest('.issue-preview, .home-issue').hasClass("clickable-block")) {
				var url = $(this).data("href");
			} else {
				return;
			}
			e.stopPropagation();


			var bodyWidth = $('body').width();

			var processResponse = function (htmlIn) {
				// Strip JavaScript blocks from input HTML
				var html = $("<div/>").append(htmlIn.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, ""));

				// Prevent scrolling
				$('html').addClass('no-scroll overlay-open');

				// Remove old overlay
				$('#overlay-content').remove();

				// Find overlay content and add to body
				var content = html.find('.main-content'),
					overlay = $('<div id="overlay-content"></div>');

				overlay
					.append(content)
					.hide()
					.appendTo('body')
					.fadeIn(duration);

				// Closing function
				overlay
					.on('hide', function () {
						$('html').removeClass('no-scroll overlay-open');
						$(this)
							.fadeOut(duration, function () {
								$(this).remove();
							});
					});

				// Issue header behaviour
				overlay
					.on('scroll', function () {
						if ($('#overlay-content').scrollTop() >= 20) {
							$('html').addClass('issue-header-fixed');
						} else {
							$('html').removeClass('issue-header-fixed');
						}
					});

				initNewsletter();

				// Place column label correctly
				if (getBreakpoint() != 'mobile') {
					positionColumnLabel(overlay, bodyWidth);
				}
			};
			$.get(url, processResponse);
			return false;
		})

	$(document).on('click', '.js-newsletter-close-button', function () {
		closeOverlayer();
	});

	$(document).on('click', '.js-overlay-close-button', function (e) {
		var historyUrl = document.referrer,
			historyHost = $('<a href="' + historyUrl + '"></a>').get(0).hostname;

		if (historyHost == location.hostname) {

			history.back(1);
			e.preventDefault();
		}
	});



	$(window).on('scroll', function (e) {
		e.preventDefault();

		if ($('.main-header').length) {
			var headerPos,
				logoPos;

			if (getBreakpoint() == 'desktop') {
				logoPos = 70;
				headerPos = 139;
			} else if (getBreakpoint() == 'mobile') {
				logoPos = 40;
				headerPos = 70;
			}
			if ($(window).scrollTop() >= headerPos) {
				$('html').addClass('header-fixed');
			} else {
				$('html').removeClass('header-fixed');
			}

			if ($(window).scrollTop() >= logoPos) {
				$('html').addClass('logo-fixed');
			} else {
				$('html').removeClass('logo-fixed');
			}
		} else if ($('.issue-header').length) {
			if ($(window).scrollTop() >= 20) {
				$('html').addClass('issue-header-fixed');
			} else {
				$('html').removeClass('issue-header-fixed');
			}
		}
	});

	// Affix scrolling
	if (getBreakpoint() != 'mobile') {
		$('.js-affix-scrolling').sysAffix({
			lockedBottom: 26,
		});

		$('.js-affix-scrolling-issue').sysAffix({
			lockedTop: 95,
			lockedBottom: 26,
		});
	}

	// Mobile menu
	$(document)
		.on('click', '.js-mobile-menu-button', function () {
			if ($('html').hasClass('mobile-menu-open')) {
				return;
			} else {
				$('html').addClass('mobile-menu-open')
			}
		})
		.on('click', '.js-mobile-menu-close-button', function () {
			$('html').removeClass('mobile-menu-open')
		});

	// Search from
	if ($('.search-form').length) {
		$('.search-form .form__input').on('focusin', function () {
			$(this).closest('form').find('.form__label').addClass('hide');
		});
	}


	$search_results = $('div.search-results').isotope({
		// options
		itemSelector: '.grid-item',
		masonry: {
			gutter: 20
		},
	});

	if ($('.search-result').length) {
		$('<div class="search-results-hidden" style="display: none;"><div class="grid-sizer"></div></div>').appendTo($('body'));
		$('.search-result').clone().appendTo($('.search-results-hidden'));
	}


	$(document).on("click", ".js-filter", function () {
		var filterValue = $(this).attr('data-filter');

		var sList = "";
		$('.js-filter').each(function () {
			var sThisVal = (this.checked ? $(this).attr('data-filter') : "");
			if (sThisVal.length > 0) {
				sList += (sList == "" ? sThisVal : ", " + sThisVal);
			}
		});
		//console.log (sList);

		if (sList.length > 0) {
			$search_results.isotope({ filter: sList });
		}

		else {

			$search_results.isotope({ filter: '*' });

		}
		//filter();

	});

	$(document).on('click', '.js-reset-filter', function () {
		$('.js-filter').prop('checked', false);
		$search_results.isotope({ filter: "*" });
		//filter();
	});

	$(document).on('click', '.js-reset-filter-group', function () {
		$(this).closest('.filter__group').find('.js-filter').prop('checked', false);
		$search_results.isotope({ filter: "*" });
		//filter();
	});

	$(document).on('click', '.js-opencall-close-button', function (e) {
		if ($('#overlay-content').length) {

			closeOverlayer();

			e.preventDefault();
		}
	});

	// MOBILE: Home > load more issues
	$(document)
		.on('click', '.js-load-more', function () {
			if (getBreakpoint() == 'mobile') {
				$('.home-issue').fadeIn();
				$(this).addClass('hidden');
			}
		});

	$(window).on('load', function () {
		affixHeight();
	});

	$(document)
		.on('click', '.clickable-block:not(.js-open-as-overlay)', function (e) {
			if ($(e.target).is('a')) {
				return;
			}
			var href = $(this).data('href');
			if (href) {
				location.href = href;
				return false;
			}
		});

	$(document)
		.on('click', 'a', function (e) {
			if (!$(this).attr('href')) {
			}
			else if (this.hostname != location.hostname && $(this).attr('href').substr(0, 7) != 'mailto:') {
				this.blur();
				window.open(this.href);
				e.preventDefault();
			}
		});

}); // end doc ready


// TWINE ADDITION:




