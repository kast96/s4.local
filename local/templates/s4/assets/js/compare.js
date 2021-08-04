
GLOBAL.masCompare = GLOBAL.masCompare || [];

function initSliderCompareCategory() {
    $(".js-slider-compare-category").each(function(){
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
            nav: false,
            dots: false,
            autoHeight: false,
            smartSpeed: 700,
            margin: 30,
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                },
                720: {
                    items: 2,
                },
                992: {
                    items: 4,
                }
            },
            onInitialize : function(event) {
            },
        }));
    });
}
function reInitSliderCompareCategory() {
    $(".js-slider-compare-category .js-slider-list").trigger('destroy.owl.carousel');
}

function initDinamicTable() {
    if (typeof(DinamicTable) === 'undefined' || !jQuery.isFunction(DinamicTable)) {
        return false;
    }

    var common = {};

    $('.JS-DinamicTable').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('dinamictable'));
        new DinamicTable(this, jQuery.extend({}, common, local));
    });
}

function movetoResultSort() {
    GLOBAL.masCompare = [];
    $('.js-moveto .js-moveto-item').each(function(index, el) {
        GLOBAL.masCompare.push($(el).data('moveto-number'));
    });

    for (let j = 0; j < GLOBAL.masCompare.length; j++) {
        var number = GLOBAL.masCompare[j],
            $item = $('.js-moveto-result .owl-item').filter('[data-moveto-number="' + number + '"]');

        $('.js-moveto-result .owl-item:last-child').before($item);
    }
}

function initMoveTo() {
    $(".js-moveto").each(function(){
        var $element = $(this),
            $item = $('.js-moveto .js-moveto-item'),
            $left = $item.find('.js-moveto-left'),
            $right = $item.find('.js-moveto-right'),
            itemLength = $item.length - 1,
            i = 0,
            k = 0;

        $(".js-moveto .js-moveto-item").each(function(){
            $(this).attr('data-moveto-number', i);
            i++;
        });

        $(".js-moveto-result .owl-item").each(function(){
            $(this).attr('data-moveto-number', k);
            k++;
        });

        $left.on('click', function(){
            var $itemCurrent = $('.js-moveto .js-moveto-item'),
                index = $(this).closest('.js-moveto .js-moveto-item').index(),
                $currentItem = $itemCurrent.eq(index),
                indexNext = index + 1,
                $nextItem = $itemCurrent.eq(indexNext);

            if (index < itemLength) {
                $currentItem.insertAfter($nextItem);
                movetoResultSort();
            }
            if (index == itemLength) {
                $currentItem.prependTo($element.find('.owl-stage'));
                movetoResultSort();
            }
        });

        $right.on('click', function(){
            var $itemCurrent = $('.js-moveto .js-moveto-item'),
                index = $(this).closest('.js-moveto .js-moveto-item').index(),
                $currentItem = $itemCurrent.eq(index),
                indexPrev = index - 1,
                $prevItem = $itemCurrent.eq(indexPrev),
                $lastItem = $itemCurrent.eq(itemLength);

            if ((index > 0) && (index <= itemLength)) {
                $currentItem.insertBefore($prevItem);
                movetoResultSort();
            }
            if (index <= 0 ) {
                $currentItem.insertAfter($lastItem);
                movetoResultSort();
            }
        });
    });
}

function initSortable() {
    $(".js-sortable .owl-stage").sortable({
        cancel: '.compare-list-item_last',
        update: function (event, ui) {
            movetoResultSort();
        },
        delay: 200,
        distance: 1
    });
    $(".js-sortable .owl-stage").disableSelection();
}
function reInitSortable() {
    $(".js-sortable .owl-stage").sortable("disable");
}

function initSliderCompare() {
    $(".js-slider-compare").each(function(){
        var $element = $(".js-slider-compare"),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: false,
            mouseDrag: false,
            touchDrag: false,
            nav: true,
            dots: false,
            autoHeight: false,
            smartSpeed: 700,
            margin: 1,
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
                }
            },
            onInitialize : function(event) {
            },
            onInitialized : function(event) {
                initDinamicTable();
                initSortable();

                $(".js-moveto .owl-item").not(':last-child').addClass('js-moveto-item');
                initMoveTo();

                $element.find('.owl-button-next').click(function() {
                    $(".js-slider-compare-result").find('.js-slider-list').trigger('next.owl.carousel');
                });

                $element.find('.owl-button-prev').click(function() {
                    $(".js-slider-compare-result").find('.js-slider-list').trigger('prev.owl.carousel');
                });
            },
            onResized : function(event) {
                initDinamicTable();
            },
        }));
    });
}

function initSliderCompareResult() {
    $(".js-slider-compare-result").each(function(){
        var $element = $(".js-slider-compare-result"),
            $list = $element.find('.js-slider-list'),
            $buttons = $element.find('.js-slider-buttons'),
            $pager = $element.find('.js-slider-pager'),
            $item = $list.find('.js-slider-item');

        var isLoop = $item.length > 1 ? true : false;

        $list.owlCarousel(jQuery.extend({}, GLOBAL.owl.common, {
            loop: false,
            mouseDrag: false,
            touchDrag: false,
            nav: true,
            dots: false,
            autoHeight: false,
            smartSpeed: 700,
            margin: 1,
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
                }
            },
            onInitialize : function(event) {
            },
            onInitialized : function(event) {
                initMoveTo();
                $element.find('.owl-button-next').click(function() {
                    $(".js-slider-compare").find('.js-slider-list').trigger('next.owl.carousel');
                });

                $element.find('.owl-button-prev').click(function() {
                    $(".js-slider-compare").find('.js-slider-list').trigger('prev.owl.carousel');
                });
            },
            onResized : function(event) {
            },
        }));
    });
}

function initResizeWindowCompare() {
    switch (GLOBAL.widthWindow) {
        case 'isMobile':
            initSliderCompareCategory();
            reInitSortable();
            break;
        case 'isTablet':
            initSliderCompareCategory();
            reInitSortable();
            break;
        default:
            reInitSliderCompareCategory();
    }
}


$(document).ready(function () {
    initResizeWindowCompare();
    $(window).resize(function(){
        initResizeWindowCompare();
    });

    initSliderCompare();
    initSliderCompareResult();
});