

function initAjaxMoreNews() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
        }
    };

    $('.JS-AjaxMore-News').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initSelectCheckbox() {
    $('.js-selectCheckbox').each(function() {
        var $input = jQuery(this).find('.js-selectCheckbox-input'),
            $link = jQuery(this).find('.js-selectCheckbox-link');

        $link.on("click", function() {
            $input.prop("checked", true);
        });
    });
}

function initPopupNewsSubscribe() {
    $('.js-popup-news-subscribe').each(function() {
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
                    initMask();
                    initTextareaSize();
                    initFiles();
                    initSelectCheckbox();
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

function initPopupFilterNews() {
    if (typeof(MobileMenu) === 'undefined' || !jQuery.isFunction(MobileMenu)) {
        return false;
    }

    var common = {};

    jQuery('.JS-PopupFilter-News').not('.JS-MobileMenu-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('mobilemenu'));
        new MobileMenu(this, jQuery.extend({}, common, local));
    });
}

function initSliderUsedProducts() {
    $(".js-slider-used-products").each(function(){
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
            onInitialized : function(event) {
            },
        }));
    });
}

$(document).ready(function () {
    initAjaxMoreNews();
    initPopupNewsSubscribe();
    initPopupFilterNews();
    initSliderUsedProducts()
});
