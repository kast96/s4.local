
function initPopupResume() {
    $('.js-popup-resume').each(function() {
        $(this).on('click',function(e) {
            e.preventDefault();
            var url = $(this).data('src'),
                id =  $(this).data('vacancy-id');

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
                    var local = GLOBAL.parseData(jQuery('.JS-PopupForm').data('popupform'));
                    new MobileMenu('.JS-PopupForm', local)._open();

                    $('.js-form-popup').find('.js-popup-resume-id').val(id);
                    $('.js-preloader').addClass('g-hidden');
                },
                error: function(data) {
                }
            });
        });
    });
}

function initAjaxMoreVacancies() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initDropdown();
            initPopupResume();
        }
    };

    $('.JS-AjaxMore-Vacancies').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

$(document).ready(function () {
    initAjaxMoreVacancies();
    initPopupResume();
});