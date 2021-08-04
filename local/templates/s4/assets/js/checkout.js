
function initSlidertab() {
    if (typeof(Slidertab) === 'undefined' || !jQuery.isFunction(Slidertab)) {
        return false;
    }

    var common = {};

    $('.JS-Slidertab').not('.JS-Slidertab-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('slidertab'));
        new Slidertab(this, jQuery.extend({}, common, local));
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

function initPopupContract() {
    $('.js-popup-contract').each(function() {
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

function initSliderRuler() {
    jQuery('.js-slider-ruler').each(function() {
        var $element = $(this),
            $track = $element.find('.js-slider-rating-track'),
            $amount = $element.find('.js-slider-rating-value'),
            $handle = $element.find('.js-ui-slider-handle'),
            $text = $element.find('.js-slider-rating-text'),
            min = $element.data('range-min') || 0,
            max = $element.data('range-max') || 0,
            step = $element.data('range-step') || 0,
            start = $element.data('range-start') || 0;

        $track.slider({
            range: "min",
            value: start,
            min: min,
            max: max,
            step: step,
            classes: {
                "ui-slider-handle": "slider-range-button",
                "ui-slider-range": "slider-range-quantity"
            },
            create: function() {
                $text.text( $( this ).slider( "value" ) );
                $amount.val( $track.slider("value") );
            },
            slide: function( event, ui ) {
                $text.text( ui.value );
                $amount.val( ui.value );
            }
        });
    });
}


$(document).ready(function () {
    initSlidertab();
    initRadio();
    initPopupContract();
    initSliderRuler();
});