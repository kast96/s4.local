!function(global) {
  'use strict';

  function Fix(elem, params) {
    this.$element = jQuery(elem);
    this.params = params || {};

    this.onInit = this.params.onInit || null;
    this.classReady = this.params.classReady || 'JS-Fix-ready';
    this.classActive = this.params.classActive || 'fix-active';
    this._update = this.params.update|| {};

    this.__construct();
  };

  Fix.prototype.__construct = function __construct() {
    this.$document = jQuery(document.body);
    this.$item = this.$element.find('.JS-Fix-Item');
    this.elementPosition = this.$item.offset().top;

    this._init();
  };

    Fix.prototype._init = function _init() {
    var _this = this;

    if( jQuery.isFunction(this.onInit) ){
      this.onInit.apply(window, []);
    }

    this._build();

    $(window).on('scroll', function(e, data) {
        _this._build.apply(_this, []);
    });

    this._ready();
  };

  Fix.prototype._ready = function _ready() {
    this.$element
      .addClass('JS-Fix-ready')
      .addClass(this.classReady);
  };

    Fix.prototype._update = function _update() {
    }

  Fix.prototype._build = function _build() {
      let windowPosition = $(window).scrollTop();

      if (windowPosition >= this.elementPosition ) {
          if (!this.$item.hasClass(this.classActive)) {
              this.$item.addClass(this.classActive);
              this._update();
          }
      } else {
          this.$item.removeClass(this.classActive);
          this._update();
      }
  }
  /*--/Fix--*/

  global.Fix = Fix;
}(this);
