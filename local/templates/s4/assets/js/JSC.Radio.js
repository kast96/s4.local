!function(global) {
  'use strict';

  function Radio( elem, params ){
    this.$element = jQuery(elem);
    this.params = params || {};

    this.classSwitcherActive = this.params.classSwitcherActive || 'JS-Radio-Switcher-active';
    this.classItemActive = this.params.classItemActive || 'JS-Radio-Item-active';
    this.classReady = this.params.classReady || 'JS-Radio-ready';
    this.onInit = this.params.onInit || null;
    this.onReady = this.params.onReady || null;

    this.__construct();
  };

  Radio.prototype.__construct = function(){
    this.$items = this.$element.find('.JS-Radio-Item');
    this.$switcherItem = this.$element.find('.JS-Radio-Switcher-Item');
    this.$switcher = this.$switcherItem.find('.JS-Radio-Switcher');

    this._init();

    this.$element.data('JS-Radio', this);
  };

  Radio.prototype._init = function(){
    var context = this;

    if( jQuery.isFunction(this.onInit) ){
      this.onInit.apply(window, [this]);
    }

    this.$switcher.on('change.JS-Radio', function(e){
      e.stopPropagation();
      context.toggle.apply(context, [this]);
    });

    this._ready();
  };

  Radio.prototype._ready = function() {
    this.$element.addClass('JS-Radio-ready').addClass(this.classReady);

    if ( jQuery.isFunction(this.onReady) ) {
      this.onReady.apply(window, [this]);
    }
  };

  Radio.prototype.toggle = function( elem ){
    var $switcherItem = jQuery(elem).closest(this.$switcherItem),
        index = $switcherItem.index(),
        $item = this.$items.eq(index);

    if (!$switcherItem.hasClass(this.classSwitcherActive)) {
      this.$switcherItem
        .removeClass(this.classSwitcherActive)
        .removeClass('JS-Radio-Switcher-active');

      $switcherItem
        .addClass(this.classSwitcherActive)
        .addClass('JS-Radio-Switcher-active');
    }

    if (!$item.hasClass(this.classItemActive)) {
      this.$items
        .removeClass(this.classItemActive)
        .removeClass('JS-Radio-Item-active')

      $item
        .addClass(this.classItemActive)
        .addClass('JS-Radio-Item-active');
    }
  };
  /*--/Radio--*/

  global.Radio = Radio;
}(this);
