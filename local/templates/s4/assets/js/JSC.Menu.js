!function(global) {
    'use strict';

    function Menu(elem, params) {
        this.$element = jQuery(elem);
        this.params = params || {};

        this.onInit = this.params.onInit || null;
        this.classReady = this.params.classReady || 'JS-Menu-ready';
        this.classActive = this.params.classActive || 'menu-active';
        this.delayHover = this.params.delayHover || 80;
        this.delayOut = this.params.delayOut || 150;

        this.__construct();
    };

    Menu.prototype.__construct = function __construct() {
        this.$document = jQuery(document.body);
        this.$item = this.$element.find('.JS-Menu-Item');

        this._init();
    };

    Menu.prototype._init = function _init() {
        var _this = this;

        if( jQuery.isFunction(this.onInit) ){
            this.onInit.apply(window, []);
        }

        var $item = this.$item;

        this.$item.hover(
            function () {
                var __this = $(this);

                $item.removeClass(_this.classActive);
                __this.addClass(_this.classActive);
            },
            function () {
                var __this = $(this);

            }
        );

        this._ready();
    };

    Menu.prototype._ready = function _ready() {
        this.$element
            .addClass('JS-Menu-ready')
            .addClass(this.classReady);
    };
    /*--/Menu--*/

    global.Menu = Menu;
}(this);
