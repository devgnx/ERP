;(function ( $, window, document, undefined ) {
  Product = function() {
    return {
      init: function( options, options2 ) {
        console.log(this.prototype[ options ]);
        if ( options  && options === "string" && this.prototype[ options ] && typeof this.prototype[ options ] === "function" ) {
          console.log(options);
          return this.prototype[ options ].apply(this, [options2]);
        } else {
          return this;
        }
      }
    }
  };

  Product.prototype.editPrice = function() {
    return Object.create( {
      DOM: {},
      options: {
        ajax: {
          url: null
        },
        selectors: (function(){
          var prefix = '.edit-price';

          return {
            wrapper: prefix,
            trigger: prefix + '-trigger',
            form:    prefix + '-form',
            input:   prefix + '-input',
            submit:  prefix + '-submit',
            cancel:  prefix + '-cancel'
          }
        })()
      },
      init: function(options, wrapper) {
        $.extend(true, this.options, options || {});

        var selectors = this.options.selectors;

        this.wrapper   = wrapper;
        this.$wrapper  = $(wrapper);
        console.log(wrapper);
        this.$trigger  = this.$wrapper.children(selectors.trigger);
        this.$form     = this.$wrapper.children(selectors.form);

        this.$input    = this.$form.children(selectors.input);
        this.$submit   = this.$form.children(selectors.submit);

        this.bindActions();

        return this;
      },
      showInput: function() {
        var selectors = this.options.selectors,
            $activeWrappers = $(selectors.wrapper + '.active');

        $activeWrappers.removeClass('active');
        $activeWrappers.find(selectors.form).hide();
        $activeWrappers.find(selectors.trigger).show();

        this.$trigger.hide();
        this.$form.show();
        this.$input.focus();

        this.$wrapper.addClass('active');
      },
      hideInput: function() {
        this.$form.hide();
        this.$trigger.show();
        this.$wrapper.removeClass('active');
      },
      onSuccess: function() {

      },
      onError: function() {

      },
      onBeforeSend: function() {

      },
      submitPrice: function() {
        var self = this;

        $.ajax({
          url: this.options.ajax.url || this.$form.data('url'),
          data: this.$form.children(':input').serialize(),
          beforeSend: function() {
            self.onBeforeSend();
          },
          success: function( data ) {
            if (data.status == 'success') {
              self.onSuccess();
            } else {
              self.onError();
            }
          },
          error: function() {
              self.onError();
          }
        });
      },
      bindActions: function() {
        var self      = this,
            selectors = this.options.selectors;

        this.$wrapper.on('click', selectors.trigger, function(e) {
          e.preventDefault();
          e.stopPropagation();
          self.showInput();

        }).on('click', selectors.submit, function(e) {
          e.preventDefault();
          e.stopPropagation();
          self.submitPrice();

        }).on('click', selectors.cancel, function(e) {
          e.preventDefault();
          e.stopPropagation();
          self.hideInput();
        });
      }
    } ).init();
  };

  $.plugin('product', Product);
})( jQuery, window, document );