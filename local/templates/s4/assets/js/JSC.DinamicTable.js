!function(global) {
  'use strict';

  function DinamicTable(elem, params) {
    this.$element = jQuery(elem);
    this.params = params || {};

    this.onInit = this.params.onInit || null;
    this.classReady = this.params.classReady || 'JS-DinamicTable-ready';
    this.classActive = this.params.classActive || 'DinamicTable-active';
    this.classShow = this.params.classShow || '';

    this.__construct();
  };

  DinamicTable.prototype.__construct = function __construct() {
    this.$document = jQuery(document.body);
    this.$item = this.$element.find('.JS-DinamicTable-Item');

    this._init();
  };

  DinamicTable.prototype._init = function _init() {
    var _this = this;

    if( jQuery.isFunction(this.onInit) ){
      this.onInit.apply(window, []);
    }

    this._build();

    this._ready();
  };

  DinamicTable.prototype._ready = function _ready() {
    this.$element
      .addClass('JS-DinamicTable-ready')
      .addClass(this.classReady);
  };

  DinamicTable.prototype._reset = function _reset() {
    this.$item.css('height', 'auto');
  };

  DinamicTable.prototype._build = function _build() {
    this._reset();

    for (let i = 1; i < this.$item.length; i++) {
      var $elements = this.$item.filter('[data-dinamictable="' + i + '"]'),
          heights = [];

      $elements.each(function(index, el) {
        heights.push($(el).height());
      });

      var height = Math.max.apply(null, heights);
      $elements.height(height);
    }
  }
  /*--/DinamicTable--*/

  global.DinamicTable = DinamicTable;
}(this);
