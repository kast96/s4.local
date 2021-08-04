
function initAjaxMorePromoFiles() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initPopupImg();
        }
    };

    $('.JS-AjaxMore-PromoFiles').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initAjaxMorePromoImg() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initPopupImg();
        }
    };

    $('.JS-AjaxMore-PromoImg').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initPopupBrand() {
    $('.js-popup-brand').each(function() {
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
                    initMask();
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


$(document).ready(function () {
    initAjaxMorePromoFiles();
    initAjaxMorePromoImg();
    initPopupBrand();
});