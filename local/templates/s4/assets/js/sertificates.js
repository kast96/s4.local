
function initAjaxMoreSertificates() {
    if (typeof(AjaxMore) === 'undefined' || !jQuery.isFunction(AjaxMore)) {
        return false;
    }

    var common = {
        success: function () {
            initPopupImg();
        }
    };

    $('.JS-AjaxMore-Sertificates').not('.JS-AjaxMore-ready').each(function(){
        var local = GLOBAL.parseData(jQuery(this).data('ajaxmore'));
        new AjaxMore(this, jQuery.extend({}, common, local));
    });
}

$(document).ready(function () {
    initAjaxMoreSertificates();
});