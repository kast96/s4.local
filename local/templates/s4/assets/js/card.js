
function initSliderCard() {
    $('.js-slider-card').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.js-slider-card-preview',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                }
            },
            {
                breakpoint: 992,
                settings: {
                    dots: true,
                }
            },
            {
                breakpoint: 720,
                settings: {
                    dots: true,
                }
            }
        ]
    });
    $('.js-slider-card-preview').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.js-slider-card',
        dots: false,
        arrows: true,
        centerMode: true,
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

function initSliderRecipes() {
    $(".js-slider-recipes").each(function(){
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
                    items: 2,
                    margin: 30,
                },
                992: {
                    items: 3,
                    margin: 30,
                }
            },
            navContainer: $buttons,
            dotsContainer: $pager,
            onInitialize : function(event) {
            },
            onInitialized : function(event) {
                initTooltipBookmarks();
            },
        }));
    });
}

function initSliderSimilarProducts() {
    $(".js-slider-similar-products").each(function(){
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
            rewind: true,
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
            onInitialized : function(event) {
                initDropdownMarks();
                initTooltipLinks();
                initPopupProduct();
                initTooltipSimpleLinks();
            },
        }));
    });
}

function initSliderOthersProducts() {
    $(".js-slider-others-products").each(function(){
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
            rewind: true,
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
            onInitialized : function(event) {
                initDropdownMarks();
                initTooltipLinks();
                initPopupProduct();
                initTooltipSimpleLinks();
            },
        }));
    });
}

function initPopupCard() {
    $(".js-popup-card").fancybox({
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

function initAjaxMoreComment() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initAccordion();
        }
    };

    $('.JS-AjaxMore-Comment').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initAjaxMoreReviews() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initAccordion();
            initPopupImg();
        }
    };

    $('.JS-AjaxMore-Reviews').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initAjaxMoreFaq() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initAccordion();
        }
    };

    $('.JS-AjaxMore-Faq').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initRadio() {
    if (typeof(Radio) === 'undefined' || !jQuery.isFunction(Radio)) {
        return false;
    }

    var common = {};

    jQuery('.JS-Radio').not('.JS-Radio-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('radio'));
        new Radio(this, jQuery.extend({}, common, local));
    });
}

function initPopupReview() {
    $('.js-popup-review').each(function() {
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
                    initFiles();
                    initRadio();
                    initPopupImg();
                    initFileImg();
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

function initGalleryVideo() {
    $('.js-gallery-video').each(function() {
        var $link = $(this).find('.js-gallery-video-link'),
            $main = $(this).find('.js-gallery-video-main');

        $link.on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src');

            $('.js-preloader').removeClass('g-hidden');

            $.ajax({
                url: url,
                type: "get",
                dataType: "html",
                success: function (data) {
                    $main.html(data);
                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}


$(document).ready(function () {
    initSliderCard();
    initSliderRecipes();
    initSliderSimilarProducts();
    initSliderOthersProducts();
    initPopupCard();
    initAjaxMoreComment();
    initAjaxMoreReviews();
    initAjaxMoreFaq();
    initRadio();
    initPopupReview();
    initGalleryVideo();
});