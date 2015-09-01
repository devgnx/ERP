;(function ( $, window, document, undefined ) {
  ProductList = {
    editPrice: {
      DOM: {},
      options: {
        ajax: {
          url: null
        },
        selectors: (function(){
          var prefix = '.edit-price';

          return {
            wrapper: prefix,
            trigger: prefix + '--trigger',
            form:    prefix + '--form',
            input:   prefix + '--input',
            submit:  prefix + '--submit',
          }
        })()
      },
      init: function(options, wrapper) {
        $.extend(true, this.options, options || {});

        var selectors = this.options.selectors;

        this.wrapper   = wrapper;
        this.$wrapper  = $(wrapper);
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

        this.$form.width( this.$trigger.width() );

        this.$trigger.hide();
        this.$form.show();
        this.$input.focus();

        this.$wrapper.addClass('active');
      },
      hideInput: function() {
        this.$form.hide().width('');
        this.$trigger.show();
        this.$wrapper.removeClass('active');
      },
      submitPrice: function() {
        $.ajax({
          url: this.options.ajax.url || this.$form.data('url'),
          data: this.$form.children(':input').serialize()
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
        });
      }
    }
  };

  $.plugin('editPrice', ProductList.editPrice);
})( jQuery, window, document );