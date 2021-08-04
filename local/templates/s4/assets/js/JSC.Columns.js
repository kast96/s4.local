!function(global) {
    'use strict';

    function Columns( elem, params ){
        this.$element = jQuery(elem);
        this.params = params || {};

        this.classReady = this.params.classReady || 'JS-Columns-ready';
        this.onInit = this.params.onInit || null;
        this.onReady = this.params.onReady || null;
        this.number = this.params.number || 4;
        this.update = this.params.update || {};

        this.__construct();
    };

    Columns.prototype.__construct = function(){
        this.$itemStartList = this.$element.find('.JS-Columns-Start-List');
        this.$itemStart = this.$itemStartList.find('.JS-Columns-Start');
        this.$itemEnd = this.$element.find('.JS-Columns-End');

        this._init();

        this.$element.data('JS-Columns', this);
    };

    Columns.prototype._init = function(){
        var context = this;

        if( jQuery.isFunction(this.onInit) ){
            this.onInit.apply(window, [this]);
        }

        this._build();

        this._ready();
    };

    Columns.prototype._ready = function() {
        this.$element.addClass('JS-Columns-ready').addClass(this.classReady);

        if ( jQuery.isFunction(this.onReady) ) {
            this.onReady.apply(window, [this]);
        }
    };

    Columns.prototype._build = function( ){
        for (let i = 0; i < this.$itemStart.length; i++) {
            var heightsMas = [],
                height,
                indexMas;

            this.$itemEnd.each(function(index, el) {
                heightsMas.push($(el).innerHeight());
            });

            height = Math.min.apply(null, heightsMas);

            indexMas = heightsMas.indexOf(height);

            var $clone = this.$itemStart.eq(i).clone();

            var $targetCol = this.$itemEnd.eq(indexMas);

            $clone.appendTo($targetCol);
        }

        this.update();
    };
    /*--/Columns--*/

    global.Columns = Columns;
}(this);
