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
});