
function initAjaxMoreActions() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
        }
    };

    $('.JS-AjaxMore-Actions').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

function initSliderActionsProducts() {
    $(".js-slider-actions-products").each(function(){
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
                initTooltipLinks();
                initPopupProduct();
                initDropdownMarks();
                initTooltipSimpleLinks();
            },
        }));
    });
}

$(document).ready(function () {
    initAjaxMoreActions();
    initSliderActionsProducts();
});