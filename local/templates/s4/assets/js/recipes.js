
function initGalleryRecipes() {
    $('.js-gallery-recipes').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.js-gallery-recipes-preview',
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
    $('.js-gallery-recipes-preview').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.js-gallery-recipes',
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

function initSliderUsedProducts() {
    $(".js-slider-products-recipes").each(function(){
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

function initSliderRecipesSimilar() {
    $(".js-slider-recipes-similar").each(function(){
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

$(document).ready(function () {
    initGalleryRecipes();
    initSliderUsedProducts();
    initSliderRecipesSimilar();
});