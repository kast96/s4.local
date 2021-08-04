
function initSliderAbout() {
    $(".js-slider-about").each(function(){
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
            },
            navContainer: $buttons,
            dotsContainer: $pager,
            onInitialize: function (event) {
            },
        }));
    });
}

$(document).ready(function () {
    initSliderAbout();
});