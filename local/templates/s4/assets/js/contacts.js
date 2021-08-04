
function initColumnsCities() {
    if (typeof(Columns) === 'undefined' || !jQuery.isFunction(Columns)) {
        return false;
    }

    var common = {
        'update': function() {
        }
    };

    jQuery('.JS-Columns-Cities').not('.JS-Columns-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('columns'));
        new Columns(this, jQuery.extend({}, common, local));
    });
}

function initPopupLocation() {
    $(".js-popup-location").each(function(){
        var $element = $(this),
            classShow = $element.data('popuplocation');

        $element.fancybox({
            type : 'ajax',
            toolbar  : false,
            smallBtn : false,
            afterShow: function (data) {
                initPopupClose();
                initColumnsCities();
                initFind();
                initScroll();
                initSearch();
                jQuery('body').addClass(classShow);
            },
            afterClose: function () {
                jQuery('body').removeClass(classShow);
            },
            baseClass: "location-popup-wrapper",
        });
    });
}

function initRegion() {
    $(".js-region").each(function(){
        var $element = $(this),
            classActive = $element.data('regionactive'),
            $item = $element.find('.js-region-item'),
            $target = $element.find('.js-region-target');

        $item.on('mouseover',function(e) {
            var itemId = $(this).data('regionid');

            $target.filter('[data-regionid="' + itemId + '"]').addClass(classActive);
        });

        $item.on('mouseout',function(e) {
            $target.removeClass(classActive);
        });
    });
}

function initBaloon() {
    $(".js-baloon").each(function(){
        var $element = $(this),
            classActive = $element.data('baloonactive'),
            $item = $element.find('.js-baloon-item'),
            $target = $element.find('.js-baloon-target');

        $item.on('mouseover',function(e) {
            var itemId = $(this).data('regionid');

            $target.filter('[data-regionid="' + itemId + '"]').addClass(classActive);
        });

        $item.on('mouseout',function(e) {
            $target.removeClass(classActive);
        });
    });
}


$(document).ready(function () {
    initPopupLocation();
    initRegion();
    initBaloon();
});
