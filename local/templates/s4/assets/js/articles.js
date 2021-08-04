
function initSliderArticles() {
    $(".js-slider-articles").each(function(){
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
                        margin: 15,
                    },
                    720: {
                        items: 1,
                        margin: 15,
                    },
                    992: {
                        items: 1,
                        margin: 30,
                    },
                    1200: {
                        items: 2,
                        margin: 30,
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

function initAjaxMoreArticles() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initSliderArticles();
            initPopupVideo();
        }
    };

    $('.JS-AjaxMore-Articles').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initPopupArticleComment() {
    $('.js-popup-article-comment').each(function() {
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

function initAjaxMoreArticlesComment() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initAccordion();
            initPopupImg();
        }
    };

    $('.JS-AjaxMore-Articles-Comment').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}


$(document).ready(function () {
    initSliderArticles();
    initAjaxMoreArticles();
    initPopupArticleComment();
    initAjaxMoreArticlesComment();
});