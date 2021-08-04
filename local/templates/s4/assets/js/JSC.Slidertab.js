!function(global) {
  'use strict';

  function Slidertab(elem, params) {
    this.$element = jQuery(elem);
    this.params = params || {};

    this.onInit = this.params.onInit || null;
    this.classReady = this.params.classReady || 'JS-Slidertab-ready';
    this.classActive = this.params.classActive || 'slidertab-active';
    this.classTabActive = this.params.classTabActive || 'slidertab-tab-active';
    this.buttonClassActive = this.params.buttonClassActive || 'slidertab-active';
    this.buttonClassHide = this.params.buttonClassHide || 'slidertab-button-hide';
    this.$count = this.params.countValue || 0;

    this.__construct();
  };

  Slidertab.prototype.__construct = function __construct() {
    this.$document = jQuery(document);
    this.$item = this.$element.find('.JS-Slidertab-Item');
    this.$tab = this.$element.find('.JS-Slidertab-Tab');
    this.$back = this.$element.find('.JS-Slidertab-Back');
    this.$next = this.$element.find('.JS-Slidertab-Next');
    this.$reset = this.$element.find('.JS-Slidertab-Reset');
    this.$step = this.$element.find('.JS-Slidertab-Step');
    this.$amount = this.$item.length;

    this._init();
  };

  Slidertab.prototype._init = function _init() {
    var _this = this;

    if( jQuery.isFunction(this.onInit) ){
      this.onInit.apply(window, []);
    }

    this._start();

    this.$back.on('click.JS-Slidertab', function(e, data) {
      e.stopPropagation();
      _this._back.apply(_this, []);
    });

    this.$next.on('click.JS-Slidertab', function(e, data) {
      e.stopPropagation();
      _this._next.apply(_this, []);
    });

    this.$reset.on('click.JS-Slidertab', function(e, data) {
      e.stopPropagation();
      _this._start.apply(_this, []);
    });

    this._ready();
  };

  Slidertab.prototype._ready = function _ready() {
    this.$element
      .addClass('JS-Slidertab-ready')
      .addClass(this.classReady);
  };

  Slidertab.prototype._start = function _start() {
    this.$item.removeClass(this.classActive);
    this.$item.eq(this.$count).addClass(this.classActive);

    this.$tab.removeClass(this.classTabActive);
    this.$tab.eq(this.$count).addClass(this.classTabActive);

    if (this.$count > 0 ) {
        this.$back
          .removeClass(this.buttonClassActive)
          .addClass(this.buttonClassActive);
    }

    if (this.$count < (this.$amount-1)) {
        this.$next
            .removeClass(this.buttonClassHide)
            .addClass(this.buttonClassActive);
    }
  };

  Slidertab.prototype._back = function _back() {
    if (this.$count <= (this.$amount-1) && this.$count >= 1) {
      this.$count--;

      this.$item.removeClass(this.classActive);
      this.$item.eq(this.$count).addClass(this.classActive);
      this.$tab.removeClass(this.classTabActive);
      this.$tab.eq(this.$count).addClass(this.classTabActive);
      this.$step.text(this.$count+1);
      this.$next.removeClass(this.buttonClassHide);

      if (!(this.$next.hasClass(this.buttonClassActive))) {
        this.$next.addClass(this.buttonClassActive);
      }

      if (this.$count == 0) {
        this.$next.addClass(this.buttonClassActive);
        this.$back.removeClass(this.buttonClassActive);
      }
    } else {
      return false;
    }
  };

  Slidertab.prototype._next = function _next() {
    if (this.$count < (this.$amount-1)) {
      this.$count++;

      this.$item.removeClass(this.classActive);
      this.$item.eq(this.$count).addClass(this.classActive);
      this.$tab.removeClass(this.classTabActive);
      this.$tab.eq(this.$count).addClass(this.classTabActive);
      this.$step.text(this.$count+1);

      if (!(this.$back.hasClass(this.buttonClassActive))) {
        this.$back.addClass(this.buttonClassActive);
      }

      if (this.$count == (this.$amount-1)) {
        this.$next
            .removeClass(this.buttonClassActive)
            .addClass(this.buttonClassHide);
      }
    } else {
      return false;
    }
  };
  /*--/Slidertab--*/

  global.Slidertab = Slidertab;
}(this);
