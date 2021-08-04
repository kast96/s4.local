/*--GLOBAL--*/
var GLOBAL = GLOBAL || {};
GLOBAL.widthWindow = GLOBAL.widthWindow || {};
GLOBAL.FORMERROR = GLOBAL.FORMERROR || {};
GLOBAL.FORMERROR.REQUIRED = GLOBAL.FORMERROR.REQUIRED || '';
GLOBAL.FORMERROR.EMAIL = GLOBAL.FORMERROR.EMAIL || '';
GLOBAL.mobile = GLOBAL.mobile || 720;
GLOBAL.tablet = GLOBAL.tablet || 992;

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
    '<i class="owl-button-icon las la-arrow-left"></i>',
    '<i class="owl-button-icon las la-arrow-right"></i>'
];

/*--/global--*/

function isMobile() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
        return true;
    } else {
        return false;
    }
}

function initPopup() {
    $(".js-popup").fancybox({
        toolbar  : false,
        smallBtn : true,
        btnTpl: {
            smallBtn:
                '<span data-fancybox-close class="fancybox-close fancybox-close_simple">' +
                '<i class="fancybox-close-icon las la-times"></i>' +
                "</span>",
        },
    });
}

function openPopupSuccess(url) {
    if (!url) {
        return false;
    }

    $.fancybox.open({
        src  : url,
        type : 'ajax'
    });
}

function initDropdown() {
    if (typeof(Dropdown) === 'undefined' || !jQuery.isFunction(Dropdown)) {
        return false;
    }

    var common = {};

    $('.JS-Dropdown').not('.JS-Dropdown-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('dropdown'));
        new Dropdown(this, jQuery.extend({}, common, local));
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

function initSelect() {
    $('.js-select').selectric({
        disableOnMobile: false,
        nativeOnMobile: false,
        arrowButtonMarkup: '<b class="selectric-button"><i class="selectric-icon"></i></b>',
    });
}

function initScrollTop() {
    var $scrolltop = $('.js-scrolltop'),
        scrolltopActiveClass = $scrolltop.data('scrolltop');

    $(window).scroll(function(){
        if ($(this).scrollTop() > 1) {
            $scrolltop.addClass(scrolltopActiveClass);
        } else {
            $scrolltop.removeClass(scrolltopActiveClass);
        }
    });
    $scrolltop.click(function(){
        $('html, body').animate({scrollTop: '0px'}, 500);
        return false;
    });
}

function initMenu() {
    if (typeof(Menu) === 'undefined' || !jQuery.isFunction(Menu)) {
        return false;
    }

    var common = {};

    $('.JS-Menu').not('.JS-Menu-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('menu'));
        new Menu(this, jQuery.extend({}, common, local));
    });
}

function initMozaic() {
    $('.js-mozaic').each(function() {
        $(this).masonry({
            itemSelector: '.js-mozaic-item',
            columnWidth: '.js-mozaic-item',
            percentPosition: true
        });
    });
}

function initPopupClose() {
    $(".js-popup-close").on('click', function(e) {
        $.fancybox.close();
    });
}

function initPopupSearch() {
    $(".js-popup-search").fancybox({
        type : 'ajax',
        toolbar  : false,
        smallBtn : false,
        afterShow: function (data) {
            initPopupClose();
            initSearch();
        },
        baseClass: "search-popup-wrapper",
    });
}


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

function initParallaxHeader() {
    $(".js-parallax-banner").each(function(){
        var scene = this;
        var parallaxInstance = new Parallax(scene, {
            relativeInput: true,
            hoverOnly: true,
            pointerEvents: true,
        });
    });
}

function initParallaxCategory() {
    $(".js-parallax-category").each(function(){
        var scene = this;
        var parallaxInstance = new Parallax(scene, {
            relativeInput: true,
            hoverOnly: true,
            pointerEvents: true,
        });
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
                onInitialize: function (event) {
                    initParallaxHeader();
                },
            }));
        }
    });
}

function initSliderBranches() {
    $(".js-slider-branches").each(function(){
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
                smartSpeed: 400,
                responsive: {
                    0: {
                        items: 1,
                        margin: 10,
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

function initSliderBrands() {
    $(".js-slider-brands").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        if ($item.length > 1) {
            $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
                nav: true,
                autoHeight: false,
                margin: 0,
                smartSpeed: 500,
                responsive: {
                    0: {
                        items: 1,
                        autoWidth: true,
                        center: true,
                        startPosition: 1,
                    },
                    720: {
                        items: 3,
                        mouseDrag: true,

                    },
                    992: {
                        items: 5,
                    },
                    1200: {
                        items: 5,
                        mouseDrag: false,
                    },
                },
                navContainer: $buttons,
                dotsContainer: $pager,
            }));
        }
    });
}

function initSliderAnnounce() {
    $(".js-slider-announce").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        if ($item.length > 1) {
            $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
                nav: true,
                autoHeight: false,
                smartSpeed: 600,
                responsive: {
                    0: {
                        items: 1,
                        margin: 10,
                    },
                    720: {
                        items: 1,
                        margin: 30,
                    },
                    992: {
                        items: 1,
                        margin: 15,
                    }
                },
                navContainer: $buttons,
                dotsContainer: $pager,
                onInitialize: function (event) {
                },
            }));
        }
    });
}

function initPassword() {
    jQuery('.js-password').each(function() {
        var $element = jQuery(this),
            $link = $element.find('.js-password-link'),
            $input = $element.find('.js-password-input'),
            $classActive = $element.data('password');

        $link.on("click", function() {
            $element.toggleClass($classActive);
            if ($input.attr('type') == 'password') {
                $input.attr('type','text');
            } else {
                $input.attr('type','password');
            }
        });
    });
}

function initFieldText() {
    if (typeof(FieldText) === 'undefined' || !jQuery.isFunction(FieldText)) {
        return false;
    }

    var common = {};

    jQuery('.JS-FieldText').not('.JS-FieldText-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('fieldtext'));
        new FieldText(this, jQuery.extend({}, common, local));
    });
}

function initScroll() {
    $('.js-custom-scroll').each(function(){
        var customScroll = this;
        new SimpleBar(customScroll, {
            autoHide: false
        });
    });
}

function initPopupForm() {
    if (typeof(MobileMenu) === 'undefined' || !jQuery.isFunction(MobileMenu)) {
        return false;
    }

    var common = {};

    jQuery('.JS-PopupForm').not('.JS-MobileMenu-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('popupform'));
        new MobileMenu(this, jQuery.extend({}, common, local));
    });
}

function initTextareaSize() {
    $('.js-textarea-size').on('input', function (e) {
        e.target.style.innerHeight = 'auto';
        e.target.style.height = e.target.scrollHeight + "px";
    });
}

function initPopupProfile() {
    $('.js-popup-profile').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initPassword();
                    initFieldText();
                    initValidate();
                    initMask();
                    initForm();
                    initPopupRegistration();
                    initPopupForgot();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupForgot() {
    $('.js-open-password').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initPassword();
                    initFieldText();
                    initValidate();
                    initMask();
                    initForm();
                    initPopupProfile();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupRegistration() {
    $('.js-popup-reg').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initPassword();
                    initFieldText();
                    initValidate();
                    initMask();
                    initForm();
                    initPopupProfile();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupSubscribe() {
    $('.js-popup-subscribe').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initSelect();
                    initPassword();
                    initFieldText();
                    initValidate();
                    initForm();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupCallback() {
    $('.js-popup-callback').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initFieldText();
                    initValidate();
                    initMask();
                    initForm();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupFeedback() {
    $('.js-popup-feedback').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initFieldText();
                    initValidate();
                    initForm();
                    initTextareaSize();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupImg() {
    $(".js-popup-img").fancybox({
        loop: true,
        infobar: false,
        toolbar  : false,
        smallBtn : true,
        arrows : false,
        animationEffect: "fade",
        btnTpl: {
            smallBtn:
                '<span data-fancybox-close class="fancybox-close fancybox-close_simple">' +
                '<i class="fancybox-close-icon las la-times"></i>' +
                "</span>",
        },
        beforeClose: function (instance) {
        },
        afterLoad: function(instance, current) {
            if ( instance.group.length > 1 && current.$content ) {
                current.$content.append('' +
                    '<div class="fancybox-nav-block">' +
                    '<button class="fancybox-button fancybox-button--arrow_left prev" data-fancybox-prev>' +
                    '<i class="fancybox-button-icon fancybox-button-icon_left las la-arrow-left"></i></button>' +
                    '<button class="fancybox-button fancybox-button--arrow_right next" data-fancybox-next>' +
                    '<i class="fancybox-button-icon fancybox-button-icon_right las la-arrow-right"></i></button>' +
                    '</div>'
                );
            }
        }
    });
}

function initPopupVideo() {
    $(".js-popup-video").fancybox({
        loop: true,
        infobar: false,
        toolbar  : false,
        smallBtn : true,
        arrows : false,
        animationEffect: "fade",
        btnTpl: {
            smallBtn:
                '<span data-fancybox-close class="fancybox-close fancybox-close_simple">' +
                '<i class="fancybox-close-icon las la-times"></i>' +
                "</span>",
        },
        beforeClose: function (instance) {
        },
        afterLoad: function(instance, current) {
            if ( instance.group.length > 1 && current.$content ) {
                current.$content.append('' +
                    '<div class="fancybox-nav-block">' +
                    '<button class="fancybox-button fancybox-button--arrow_left prev" data-fancybox-prev>' +
                    '<i class="fancybox-button-icon fancybox-button-icon_left las la-arrow-left"></i></button>' +
                    '<button class="fancybox-button fancybox-button--arrow_right next" data-fancybox-next>' +
                    '<i class="fancybox-button-icon fancybox-button-icon_right las la-arrow-right"></i></button>' +
                    '</div>'
                );
            }
        }
    });
}

function initPopupNote() {
    $('.js-popup-note').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initSelect();
                    initFieldText();
                    initForm();
                    initValidate();
                    initTextareaSize();
                    initPopupImg();
                    initFiles();
                    initEditor();
                    initSelectSearch();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupComment() {
    $('.js-popup-comment').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initSelectSearch();
                    initSelect();
                    initFieldText();
                    initForm();
                    initValidate();
                    initTextareaSize();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initPopupCompare() {
    $('.js-popup-compare').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('.js-form-popup').html(data);
                    initScroll();
                    initSelectSearch();
                    initSelect();
                    initFieldText();
                    initForm();
                    initValidate();
                    initTextareaSize();
                    initPopupForm();
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

/* Catalog */
function initSelectSort() {
    $('.js-select-sort').selectric({
        disableOnMobile: false,
        nativeOnMobile: false,
        arrowButtonMarkup: '<b class="selectric-button"><i class="selectric-icon"></i></b>',
        labelBuilder: function(itemData) {
            return '<span class="' +
                        itemData.className +
                    '">' +
                        itemData.text +
                    '</span>';
        },
    });
}
/* /Catalog */

function initTooltip() {
    $('.js-tooltip').each(function() {
        var $content = $(this).find('.js-tooltip-content'),
        classElement = $(this).data('tooltip-class');

        Tipped.create($(this), $content, {
            position: 'right',
            size: 'x-small',
            skin: 'light',
            hideOthers: true,
        });
    });
}

function initTooltipLinks() {
    $('.js-tooltip-links').each(function() {
        var $content = $(this).find('.js-tooltip-content'),
            classElement = $(this).data('tooltip-class');

        Tipped.create($(this), $content, {
            position: 'left',
            size: 'x-small',
            skin: 'light',
            hideOthers: true,
        });
    });
}

function initTooltipSimpleLinks() {
    $('.js-tooltip-simple-links').each(function() {
        var $content = $(this).find('.js-tooltip-content'),
            classElement = $(this).data('tooltip-class');

        Tipped.create($(this), $content, {
            position: 'top',
            size: 'x-small',
            skin: 'light',
            hideOthers: true,
        });
    });
}

function initTooltipBookmarks() {
    $('.js-tooltip-bookmarks').each(function() {
        var $content = $(this).find('.js-tooltip-content'),
            classElement = $(this).data('tooltip-class');

        Tipped.create($(this), $content, {
            position: 'left',
            size: 'x-small',
            skin: 'light',
            hideOthers: true,
        });
    });
}

function initAccordionMarks() {
    if (typeof(Accordion) === 'undefined' || !jQuery.isFunction(Accordion)) {
        return false;
    }

    var common = {};

    $('.JS-Accordion-Marks').not('.JS-Accordion-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('accordion'));
        new Accordion(this, jQuery.extend({}, common, local));
    });
}

function initSliderAnnounceProducts() {
    $(".js-slider-announce-products").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: isLoop,
            mouseDrag: isLoop,
            touchDrag: isLoop,
            nav: true,
            autoHeight: false,
            smartSpeed: 500,
            responsive:  {
                0: {
                    items: 1,
                    margin: 10,
                },
                720: {
                    items: 1,
                    margin: 30,
                },
                992: {
                    items: 2,
                    margin: 30,
                }
            },
            navContainer: $buttons,
            dotsContainer: $pager,
            onInitialize : function(event) {
            },
        }));
    });
}

function initSliderPopularReviews() {
    $(".js-slider-popular-reviews").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: isLoop,
            mouseDrag: isLoop,
            touchDrag: isLoop,
            nav: true,
            autoHeight: false,
            smartSpeed: 700,
            responsive:  {
                0: {
                    items: 1,
                    margin: 10,
                },
                720: {
                    items: 1,
                    margin: 30,
                },
                992: {
                    items: 1,
                    margin: 30,
                }
            },
            navContainer: $buttons,
            dotsContainer: $pager,
            onInitialize : function(event) {
            },
        }));
    });
}

function initSliderViewedProducts() {
    $(".js-slider-viewed-products").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: isLoop,
            mouseDrag: isLoop,
            touchDrag: isLoop,
            nav: true,
            autoHeight: false,
            smartSpeed: 700,
            responsive:  {
                0: {
                    items: 1,
                    margin: 10,
                },
                720: {
                    items: 3,
                    margin: 30,
                },
                992: {
                    items: 4,
                    margin: 30,
                }
            },
            navContainer: $buttons,
            dotsContainer: $pager,
            onInitialize : function(event) {
            },
            initialized : function(event) {
            },
        }));
    });
}

function initSliderCategory() {
    $(".js-slider-category").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: isLoop,
            mouseDrag: isLoop,
            touchDrag: isLoop,
            nav: false,
            dots: false,
            autoHeight: false,
            smartSpeed: 700,
            margin: 9,
            items: 1,
            onInitialize : function(event) {
            },
        }));
    });
}
function reInitSliderCategory() {
    $(".js-slider-category .js-slider-list").trigger('destroy.owl.carousel');
}

function initExpand() {
    jQuery('.js-expand').each(function() {
        var $element = $(this),
            $block = $element.find('.js-expand-block'),
            $link = $element.find('.js-expand-link'),
            local = GLOBAL.parseData(jQuery(this).data('expand')),
            classActive = local.classActive || 'active',
            classShow = local.classShow || 'show',
            heightParent = parseInt($block.css('min-height'),10) || 25,
            heightChild = $block.height();

        if (heightChild > heightParent) {
            $element.addClass(classActive);

            $link.on("click", function() {
                $element.addClass(classShow);
            });
        }
    });
}

function initQuantity() {
    if (typeof(Quantity) === 'undefined' || !jQuery.isFunction(Quantity)) {
        return false;
    }

    var common = {};

    $('.JS-Quantity').not('.JS-Quantity-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('quantity'));
        new Quantity(this, jQuery.extend({}, common, local));
    });
}

function initShowMore() {
    if (typeof(ShowMore) === 'undefined' || !jQuery.isFunction(ShowMore)) {
        return false;
    }
    var common = { };

    $('.JS-ShowMore').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('showmore'));
        new ShowMore(this, jQuery.extend({}, common, local));
    });
}

function initShowMoreCategory(showmoreExtra) {
    if (typeof(ShowMore) === 'undefined' || !jQuery.isFunction(ShowMore)) {
        return false;
    }
    var common = { },
        showmoreExtra = showmoreExtra || {};

    $('.JS-ShowMoreCategory').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('showmore'));
        new ShowMore(this, jQuery.extend({}, common, local, showmoreExtra));
    });
}

function initSliderProduct() {
    $('.js-slider-product').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.js-slider-product-preview'
    });
    $('.js-slider-product-preview').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.js-slider-product',
        dots: false,
        arrows: true,
        centerMode: false,
        focusOnSelect: true,
        vertical: false,
        verticalSwiping: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                }
            },
            {
                breakpoint: 992,
                settings: {
                }
            },
            {
                breakpoint: 720,
                settings: {
                }
            }
        ]
    });
}

function initPopupProduct() {
    $(".js-popup-product").fancybox({
        type : 'ajax',
        toolbar  : false,
        smallBtn : true,
        afterShow: function (data) {
            initSliderProduct();
            initQuantity();
            initShowMore();
            initTooltipSimpleLinks();
            initTooltip();
        },
    });
}

function initSliderRange() {
    jQuery('.js-slider-range').each(function() {
        var $element = $(this),
            $track = $element.find('.js-slider-range-track');

        var min = Number($(this).find('.min-price').attr('data-value'));
        var max = Number($(this).find('.max-price').attr('data-value'));

        var price_id = $(this).attr('data-code');

        $track.slider({
            range: true,
            min: min,
            max: max,
            drag: true,
            values: [min, max],
            classes: {
                "ui-slider-handle": "slider-range-button",
                "ui-slider-range": "slider-range-quantity"
            },
            slide: function (event, ui) {
                $("input#minCost_" + price_id).val(ui.values[0]);
                $("input#maxCost_" + price_id).val(ui.values[1]);

                $('#minCost_' + price_id).trigger('change');
            },
            stop: function (event, ui) {
                $("input#minCost_" + price_id).val(ui.values[0]);
                $("input#maxCost_" + price_id).val(ui.values[1]);

                $('#minCost_' + price_id).trigger('change');
            }
        });
    });
}

function initAccordion() {
    if (typeof(Accordion) === 'undefined' || !jQuery.isFunction(Accordion)) {
        return false;
    }

    var common = {};

    $('.JS-Accordion').not('.JS-Accordion-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('accordion'));
        new Accordion(this, jQuery.extend({}, common, local));
    });
}

function initAccordionPacking() {
    if (typeof(Accordion) === 'undefined' || !jQuery.isFunction(Accordion)) {
        return false;
    }

    var common = {};

    $('.JS-Accordion-Packing').not('.JS-Accordion-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('accordion'));
        new Accordion(this, jQuery.extend({}, common, local));
    });
}

function initAccordionPackingTable() {
    if (typeof(Accordion) === 'undefined' || !jQuery.isFunction(Accordion)) {
        return false;
    }

    var common = {};

    $('.JS-Accordion-PackingTable').not('.JS-Accordion-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('accordion'));
        new Accordion(this, jQuery.extend({}, common, local));
    });
}

function initPopupFilter() {
    if (typeof(MobileMenu) === 'undefined' || !jQuery.isFunction(MobileMenu)) {
        return false;
    }

    var common = {};

    jQuery('.JS-PopupFilter').not('.JS-MobileMenu-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('mobilemenu'));
        new MobileMenu(this, jQuery.extend({}, common, local));
    });
}

function initAjaxMore() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initAccordionMarks();
            initTooltip();
            initTooltipLinks();
            initPopupProduct();
            initDropdownMarks();
            initTooltipSimpleLinks();
        }
    };

    $('.JS-AjaxMore').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initAjaxMoreRecipes() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initTooltipBookmarks();
        }
    };

    $('.JS-AjaxMore-Recipes').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initDropdownMarks() {
    if (typeof(Dropdown) === 'undefined' || !jQuery.isFunction(Dropdown)) {
        return false;
    }

    var common = {};

    $('.JS-Dropdown-Marks').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('dropdown'));
        new Dropdown(this, jQuery.extend({}, common, local));
    });
}

function initDropdownSearch() {
    if (typeof(DropSearch) === 'undefined' || !jQuery.isFunction(DropSearch)) {
        return false;
    }

    var common = { };

    $('.JS-DropSearch-Search').not('.JS-DropSearch-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('dropsearch'));
        new DropSearch(this, jQuery.extend({}, common, local));
    });
}

function initSearch() {
    $('.js-search').each(function(){
        var $element = $(this),
            classDynamic = $(this).data('search-dynamic'),
            $input = $(this).find('.js-search-input'),
            $link = $(this).find('.js-search-reset');

        $link.on('click', function(e, data) {
            $input.val('');
            $element.removeClass(classDynamic);
            initFind();
        });

        $input.on('input', function(e, data) {
            var val = $input.val();
            if (val != '') {
                $element.addClass(classDynamic);
            } else {
                $element.removeClass(classDynamic);
            }
        });
    });
}

function initShowMoreProps(showmoreExtra) {
    if (typeof(ShowMore) === 'undefined' || !jQuery.isFunction(ShowMore)) {
        return false;
    }
    var common = { },
        showmoreExtra = showmoreExtra || {};

    $('.JS-ShowMore-Props').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('showmore'));
        new ShowMore(this, jQuery.extend({}, common, local, showmoreExtra));
    });
}

function initTab() {
    if (typeof(Tab) === 'undefined' || !jQuery.isFunction(Tab)) {
        return false;
    }

    var common = {};

    jQuery('.JS-Tab').not('.JS-Tab-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('tab'));
        new Tab(this, jQuery.extend({}, common, local));
    });
}

function initSliderNoteVideo() {
    $(".js-slider-note-video").each(function(){
        var $element = $(this),
            $list = $element.find('.js-slider-list'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: isLoop,
            mouseDrag: isLoop,
            touchDrag: isLoop,
            nav: false,
            dots: false,
            autoHeight: false,
            smartSpeed: 700,
            margin: 10,
            items: 1,
            onInitialize : function(event) {
            },
        }));
    });
}
function reInitSliderNoteVideo() {
    $(".js-slider-note-video .js-slider-list").trigger('destroy.owl.carousel');
}

function initFileImg() {
    $('.js-file-img-input').MultiFile({
        STRING: {
            remove: '<i class="reviews-form-gallery-close las la-times"></i>'
        }
    });
}

function initFiles() {
    $('.js-file-input').MultiFile({
        STRING: {
            remove: '<i class="file-name-close las la-times"></i>'
        }
    });
}

function initFind() {
    $('.js-find').each(function () {
        var $element = $(this),
            $input = $element.find('.js-find-input'),
            $item = $element.find('.js-find-container'),
            $value = $element.find('.js-find-value'),
            classHide = $element.data('find-hide') || 'find-hide';

        function startFind() {
            var value = $input.val().toUpperCase();

            $item.removeClass(classHide);

            if (value.length) {
                for (let i = 0; i < $value.length; i++) {
                    var text = $($value[i]).text().toUpperCase();
                    if (!(text.indexOf(value) + 1)) {
                        $($value[i]).closest('.js-find-container').addClass(classHide);
                    }
                }
            }
        }
        startFind();

        $input.on('input', function(){
            startFind();
        });
    });
}

function initSelectSearch() {
    $('.js-find-select').each(function() {
        var $element = $(this),
            $input = $element.find('.js-find-select-input'),
            $select = $element.find('.js-select-search');

        $select.selectric({
            disableOnMobile: false,
            nativeOnMobile: false,
            arrowButtonMarkup: '<b class="selectric-button"><i class="selectric-icon"></i></b>',
            onInit: function() {
                $input.on('input', function(){
                    var value = this.value.toUpperCase(),
                        values = $element.find('.selectric-scroll ul li'),
                        itemHide = $element.find('.selectric-element-hide');

                    values.removeClass('selectric-element-hide');
                    $('.selectric-select_search .selectric-items').removeClass('selectric-items-hide');
                    if (value.length) {
                        for (let i = 0; i < values.length; i++) {
                            var text = $(values[i]).text().toUpperCase();
                            if (!(text.indexOf(value) + 1)) {
                                $(values[i]).addClass('selectric-element-hide');
                                $select.selectric('open');
                            }
                        }
                    }
                    if (values.length == itemHide.length) {
                        $('.selectric-select_search .selectric-items').addClass('selectric-items-hide');
                    }
                });
                $input.on('focus', function(){
                    $(this).val('');
                });
            },
            onChange: function() {
                var $name = this.options[this.selectedIndex].text;
                $input.val($name);
            },
        });
    });
}

function initScrollTarget() {
    var heightHead = 73,
        heightHeadMobile = 51,
        speed = 50;

    $('.js-scrolltarget-link').each(function() {
        $link = $(this);

        $link.on('click',function(e) {
            $id = $(this).attr('href');

            var top = $($id).offset().top;

            if (GLOBAL.widthWindow == 'isMobile') {
                difference = heightHeadMobile;
            } else {
                difference = heightHead;
            }

            var finalTop = top - difference;

            $('html, body').animate({
                scrollTop: finalTop
            }, speed);
        });
    });
}

function initFieldDisabled() {
    $('.js-fieldDisabled').each(function() {
        var $element = $(this),
            $input = $element.find('.js-fieldDisabled-input'),
            disabledClass = $element.data('fielddisabled');

        if ($input.is(':disabled')) {
            $element.addClass(disabledClass);
        } else {
            $element.removeClass(disabledClass);
        }
    });
}

function initResizeWindow() {
    var width = $(window).width();
    if (width <= GLOBAL.mobile) {
        GLOBAL.widthWindow = 'isMobile';
        initSliderCategory();
        initAccordionPackingTable();

        var localExtraProps = GLOBAL.parseData(jQuery('.JS-ShowMore-Props').data('showmore-extra'));
        initShowMoreProps(localExtraProps);

        initSliderNoteVideo();
    } else if (width <= GLOBAL.tablet) {
        GLOBAL.widthWindow = 'isTablet';
        reInitSliderCategory();

        var localExtra = GLOBAL.parseData(jQuery('.JS-ShowMoreCategory').data('showmore-extra'));
        initShowMoreCategory(localExtra);

        initShowMoreProps();
        reInitSliderNoteVideo();
    } else {
        GLOBAL.widthWindow = '';
        reInitSliderCategory();
        initShowMoreCategory();
        reInitSliderNoteVideo();
    }
}

$(document).ready(function () {
    initResizeWindow();
    $(window).resize(function(){
        initResizeWindow();
        initAdaptiveMenu();
    });

    initPopup();
    initPopupSearch();
    initMobileMenu();
    initDropdown();
    initForm();
    initValidate();
    initMask();
    initSelect();
    initScrollTop();
    initMenu();
    initMozaic();
    initAdaptiveMenu();
    initFix();

    initSliderBanner();
    initSliderBranches();
    initSliderBrands();
    initSliderAnnounce();
    initSliderAnnounceProducts();
    initSliderPopularReviews();
    initSliderViewedProducts();

    initParallaxHeader();
    initParallaxCategory();
    initPassword();
    initFieldText();
    initScroll();
    initTextareaSize();
    initPopupForm();
    initPopupProfile();
    initPopupRegistration();
    initPopupSubscribe();
    initPopupCallback();
    initPopupFeedback();
    initPopupImg();
    initPopupVideo();
    initPopupNote();
    initPopupComment();
    initPopupCompare();

    initSelectSort();
    initTooltip();
    initTooltipLinks();
    initTooltipSimpleLinks();
    initTooltipBookmarks();
    initAccordionMarks();
    initExpand();
    initQuantity();
    initShowMore();
    initSliderProduct();
    initPopupProduct();
    initSliderRange();
    initAccordion();
    initAccordionPacking();
    initPopupFilter();
    initAjaxMore();
    initAjaxMoreRecipes();
    initDropdownMarks();
    initDropdownSearch();
    initSearch();
    initTab();
    initFiles();
    initFileImg();
    initFind();
    initSelectSearch();
    initScrollTarget();
    initFieldDisabled();
});
