
function initColumns() {
    if (typeof(Columns) === 'undefined' || !jQuery.isFunction(Columns)) {
        return false;
    }

    var common = {
        'update': function() {
            initShowMore();
        }
    };

    jQuery('.JS-Columns').not('.JS-Columns-ready').each(function() {
        var local = GLOBAL.parseData(jQuery(this).data('columns'));
        new Columns(this, jQuery.extend({}, common, local));
    });
}

$(document).ready(function () {
    initColumns();
});