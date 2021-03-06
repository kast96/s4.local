/*--GLOBAL--*/
var GLOBAL = GLOBAL || {};
GLOBAL.FORMERROR = GLOBAL.FORMERROR || {};
GLOBAL.FORMERROR.REQUIRED = GLOBAL.FORMERROR.REQUIRED || '';
GLOBAL.FORMERROR.EMAIL = GLOBAL.FORMERROR.EMAIL || '';

GLOBAL.parseData = function parseData(data) {
	try {
		data = JSON.parse(data.replace(/'/gim, '"'));
	} catch(e) {
		data = {};
	}
	return data;
};

GLOBAL.owl = GLOBAL.owl || {};
GLOBAL.owl.common = GLOBAL.owl.common || {};
GLOBAL.owl.common.loop = true;
GLOBAL.owl.common.dots = true;
GLOBAL.owl.common.dotsData = true;
GLOBAL.owl.common.margin = 0;
GLOBAL.owl.common.responsiveClass = true;
GLOBAL.owl.common.autoHeight = true;
GLOBAL.owl.common.mouseDrag = true;
GLOBAL.owl.common.navClass = ['owl-button owl-button-prev','owl-button owl-button-next'];
GLOBAL.owl.common.navText = [
	'<i class="owl-button-icon fa fa-chevron-left"></i>',
	'<i class="owl-button-icon fa fa-chevron-right"></i>'
];



function initPopupFeedback() {
	$('.js-popup-feedback').each(function() {
		$(this).fancybox({
			type: 'ajax',
			afterShow: function(instance, current) {
				initForm();
				initValidate();
				initMask();
			}
		});
	});
}

function initForm() {
	jQuery('.js-form').each(function() {
		var $checkbox = $(this).find('.js-form-checkbox'),
			$button = $(this).find('.js-form-button'),
			classDisabled = $(this).data('form-disabled');

		if ($checkbox.is(':checked')) {
			$button.removeClass(classDisabled);
		} else {
			$button.addClass(classDisabled);
		}

		$checkbox.on("change", function(e) {
			e.stopPropagation();
			if ($checkbox.is(':checked')) {
				$button.prop("disabled", false);
				$button.removeClass(classDisabled);
			} else {
				$button.prop("disabled", true);
				$button.addClass(classDisabled);
			}
		});
	});
}

function initValidate($element) {
	if (typeof($element) == 'undefined') {
		$element = $('.js-form-validate');
	}

	$element.each(function() {
		var $element = jQuery(this),
			validator;

		validator = $element.validate({
			errorClass: 'form-error',
			validClass: 'form-success',
		});

		$.validator.messages.required = GLOBAL.FORMERROR.REQUIRED;
		$.validator.messages.email = GLOBAL.FORMERROR.EMAIL;
	});
}

function initMask() {
	$('.js-phone').mask('+7 (999) 999-99-99');
}

$(document).on('submit', '.js-form-ajax', function() {
	$this = $(this);

	if ($this.hasClass('is-send'))
		return false;

	$this.addClass('is-send');
	$.ajax({
		url: $this.attr('action'),
		type: "POST",
		dataType: "html",
		data: $this.serialize(),
		success: function(result) {
			$this.html($(result).find('.js-form-ajax').html());
			initJsAfterAjaxForm();
			$this.removeClass('is-send');
		},
		error: function(response) {
			$this.prepend('<div class="alert alert-danger">Request error</div>');
			$this.removeClass('is-send');
		}
	});
	return false; 
});

function initJsAfterAjaxForm() {
	initValidate();
	initForm();
	initMask();
}

$(document).on('click', '.js-pagen-ajax', function(e){
	e.preventDefault();
	var classProcess = 'load-more_active';
	var $this = $(this);
	var $container = $this.closest('.js-pagen');
	var link = $container.find('.js-pagen-next').attr('href');
	var $pagerContainer = $container.find('.js-pagen-pager');
	var $contentContainer = $container.find('.js-pagen-content');

	if ($this.hasClass(classProcess)) {
		return;
	}

	$this.addClass(classProcess);

	$.ajax({
		url: link,
		dataType: "html",
		success: function(result) {
			$contentContainer.append($(result).find('.js-pagen-content').html());
			$pagerContainer.html($(result).find('.js-pagen-pager').html());
			window.history.pushState('', '', link);
			$this.removeClass(classProcess);
		},
		error: function(response) {
			$this.removeClass(classProcess);
		}
	});
});

function initAdaptiveMenu() {
	$('.js-adaptivemenu').each(function() {
		var $navItemMore = $(this).find('.js-adaptivemenu-more'),
			$navItems = $(this).find('.js-adaptivemenu-item'),
			targetClass = '.js-adaptivemenu-target',
			navItemWidth = $navItemMore.width(),
			windowWidth = $(this).width();

		$navItemMore.before($(targetClass + ' > li'));

		$navItems.each(function () {
			navItemWidth += $(this).width();
		});

		navItemWidth > windowWidth ? $navItemMore.show() : $navItemMore.hide();

		while (navItemWidth > windowWidth) {
			navItemWidth -= $navItems.last().width();
			$navItems.last().prependTo(targetClass);
			$navItems.splice(-1, 1);
		}
	});
}


function initFix() {
	if (typeof(Fix) === 'undefined' || !jQuery.isFunction(Fix)) {
		return false;
	}

	var common = {
		update: function (){
			initAdaptiveMenu();
		}
	};

	$('.JS-Fix').not('.JS-Fix-ready').each(function(){
		var local = GLOBAL.parseData(jQuery(this).data('fix'));
		new Fix(this, jQuery.extend({}, common, local));
	});
}

function initMobileMenu() {
	if (typeof(MobileMenu) === 'undefined' || !jQuery.isFunction(MobileMenu)) {
		return false;
	}

	var common = {};

	jQuery('.JS-MobileMenu').not('.JS-MobileMenu-ready').each(function() {
		var local = GLOBAL.parseData(jQuery(this).data('mobilemenu'));
		new MobileMenu(this, jQuery.extend({}, common, local));
	});
}

function initSliderBanner() {
	$(".js-slider-banner").each(function(){
		var $element = $(this),
			$list = $element.find('.js-slider-list'),
			$buttons = $element.find('.js-slider-buttons'),
			$pager = $element.find('.js-slider-pager'),
			$item = $list.find('.js-slider-item');

		if ($item.length > 1) {
			$list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
				nav: true,
				autoHeight: false,
				smartSpeed: 700,
				responsive: {
					0: {
						items: 1,
					},
					720: {
						items: 1,
					},
					992: {
						items: 1,
					}
				},
				navContainer: $buttons,
				dotsContainer: $pager,
			}));
		}
	});
}

function initSlideParnters() {
	$(".js-slider-partners").each(function(){
		var $element = $(this),
			$list = $element.find('.js-slider-list'),
			$buttons = $element.find('.js-slider-buttons'),
			$pager = $element.find('.js-slider-pager'),
			$item = $list.find('.js-slider-item');

		if ($item.length > 1) {
			$list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
				nav: true,
				autoHeight: false,
				margin: 30,
				smartSpeed: 500,
				responsive: {
					0: {
						items: 1,
					},
					720: {
						items: 2,

					},
					992: {
						items: 3,
					},
					1200: {
						items: 4,
					},
				},
				navContainer: $buttons,
				dotsContainer: $pager,
			}));
		}
	});
}

function initSlideGallery() {
	$(".js-slider-gallery").each(function(){
		var $element = $(this),
			$list = $element.find('.js-slider-list'),
			$buttons = $element.find('.js-slider-buttons'),
			$pager = $element.find('.js-slider-pager'),
			$item = $list.find('.js-slider-item');

		if ($item.length > 1) {
			$list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
				nav: true,
				autoHeight: false,
				margin: 30,
				smartSpeed: 500,
				responsive: {
					0: {
						items: 1,
					},
					720: {
						items: 2,

					},
					992: {
						items: 3,
					},
				},
				navContainer: $buttons,
				dotsContainer: $pager,
			}));
		}
	});
}

if (typeof(ymaps) == 'object') {
	ymaps.ready(init);
} else {
	console.warn('???????????????????? ???????????????????????????????? ???????????? ??????????');
}

function init() {
	$('.js-map').each(function () {
		var centerCoord = $(this).data('centercoord') || [59.93914514163674,30.33349282507063],
			idMap = $(this).data('mapid'),
			$item = $(this).find('.js-map-item'),
			local = GLOBAL.parseData($(this).data('maplocal'));

		var myMap = new ymaps.Map(idMap, jQuery.extend({}, local, {
			center: centerCoord,
			zoom: 16,
		})),
		objectManager = new ymaps.ObjectManager(),
		masObjects =[];

		//myMap.behaviors.disable('drag');
		myMap.geoObjects.add(objectManager);

		$item.each(function () {
			var objectId = $(this).data('objectid'),
			objectCoord = $(this).data('objectcoord'),
			objectText =  $(this).find('.js-map-item-value').html();

			var elementsObjects =
			{
				"type": "Feature",
				"id": objectId,
				"options": {
					"preset": "islands#darkBlueIcon",
				},
				"geometry":{
					"type": "Point",
					"coordinates": objectCoord
				},
				"properties":{
					"balloonContentBody": '<div class="map-popup">' +
					'<div class="map-popup-body map-popup-body_simple">' + objectText + '</div>' +
					'</div>',
				}
			};

			masObjects.push(elementsObjects);
		});

		objectManager.add({
			"type": "FeatureCollection",
			"features": masObjects
		});

		objectManager.objects.events.add('click', function (e) {
			var objectId=e.get('objectId');
			viewObject(objectId);
		});

		[].forEach.call(document.querySelectorAll('[data-objectId]'), function(el) {
			el.addEventListener('click', function() {
			var objectId=el.getAttribute("data-objectId");
			viewObject(objectId);
			});
		});

		function viewObject(objectId){
			$('.js-map-item').removeClass('active');

			document.querySelector('[data-objectId="'+objectId+'"]').classList.add('active');

			objectManager.objects.each(function (item) {
				objectManager.objects.setObjectOptions(item.id, {
				preset: 'islands#darkBlueIcon'
			});
			});
			objectManager.objects.setObjectOptions(objectId, {
			preset: 'islands#darkBlueIcon'
			});

			myMap.setCenter(objectManager.objects.getById(objectId).geometry.coordinates, 15, {
			checkZoomRange: true
			});
		}
	});
}

function initBadEye() {
	var cookieOptions = {expires: 7, path: '/'};

	$('.js-badeye-switcher').on('click', function(){
		$('.js-badeye').toggleClass('is-active');
	});

	$('.js-badeye-control').on('click', function(){
		var id = $(this).attr('data-id');
		var value = $(this).attr('data-value');

		$('html').attr('data-'+id, value);
		$.cookie('eyebad-'+id, value, cookieOptions);
		$('.js-badeye-control[data-id="'+id+'"]').removeClass('is-active');
		$(this).addClass('is-active');
	});
}


$(document).ready(function () {
	$(window).resize(function(){
		initAdaptiveMenu();
	});

	initAdaptiveMenu();
	initFix();
	initValidate();
	initForm();
	initMask();
	initMobileMenu();
	initPopupFeedback();
	initSliderBanner();
	initSlideParnters();
	initSlideGallery();
	initBadEye();
});