;(function ( $, window, document, undefined ) {
  "use strict";

  var Helper = {
    extendOptions: function( options ) {
      return $.extend(true, this.options, options || {});
    },
    getSelectors: function() {
      return this.options.selectors;
    }
  };

  var Product = {
    /**
     * Loads the Product methods
     * @param  {object} elem     The current selected element
     * @param  {string} method   It's the method to be called
     * @param  {mixed}  options  These are the options to the current method called
     * @return {object} current application
     */
    init: function( elem, method, options ) {
      if ( method  && typeof method === "string" && method in this && typeof this[ method ] === "function" ) {
        return this[ method ].call( elem, options );
      } else {
        return this;
      }
    },

    /**
     * loadProduct from database to fill the input
     * @param  {object} options
     */
    loadProduct: function( options ) {
      return {
        loadProduct: Object.create($.extend(true, Helper, {
          options: {
            selectors: (function() {
              var prefix = '.hs-product-load';

              return {
                wrapper: '.hs-product-sale-fields-group',
                name:  prefix + '-name',
                id:    prefix + '-id',
                price: prefix + '-price'
              };
            })()
          },
          init: function( elem, options ) {
            this.extendOptions( options );

            var selectors = this.getSelectors();

            this.$name    = $( elem );
            this.$wrapper = this.$name.closest( selectors.wrapper );
            this.$id      = this.$wrapper.find( selectors.id );
            this.$price   = this.$wrapper.find( selectors.price );

            this.bindActions();

            return this;
          },
          bindActions: function() {
            var self = this,
                selectors = this.getSelectors();

            this.$name.autocomplete({
              serviceUrl: self.$name.data('url'),
              onSelect: function( value ) {
                self.$id.val( value.data ).trigger('change');
                self.$price.val( value.price.replace('.', ',') ).trigger('change');
              }
            });

            return this;
          }
        } )).init( this, options )
      }
    },

    /**
     * addSaleFields adds a new group of fields on SaleController@create route
     * @param {object} options
     */
    addSaleFields: function( options ) {
      return {
        addSaleFields: Object.create($.extend(true, Helper, {
          options: {
            onAppend: function( instance ){ return instance },
            selectors: (function() {
              var prefix = '.hs-product-sale-fields';

              return {
                wrapper: prefix,
                triggerAdd: prefix + '-add',
                triggerRemove: prefix + '-remove',
                triggerUndo: prefix + '-undo',
                template: prefix.replace('.', '#') + '-template',
                fieldsGroup: prefix + '-group'
              };
            })()
          },
          init: function( elem, options ) {
            this.extendOptions( options );

            var selectors = this.getSelectors();

            this.$wrapper = $( elem );
            window.productAddSaleFieldsSafeData = null;

            this.bindActions();

            return this;
          },
          appendFieldsGroup: function( trigger, template ) {
            var selectors = this.getSelectors(), $fieldsGroup, callback;

            if (! template) {
              template = $( selectors.template ).html();
              callback = this.options.onAppend;
            }

            $fieldsGroup = $( trigger ).closest( selectors.fieldsGroup )
              .removeClass('hs-show-undo')
              .after( template )
              .next();

            if (typeof callback === 'function') {
              callback.call( $fieldsGroup, this );
            }

            return this;
          },
          removeFieldsGroup: function( trigger ) {
            var selectors = this.getSelectors(),
                $fieldsGroup = $( trigger ).closest( selectors.fieldsGroup );

            $fieldsGroup.prev( selectors.fieldsGroup ).addClass('hs-show-undo');

            window.productAddSaleFieldsSafeData = $fieldsGroup.removeClass('hs-show-undo').detach();
          },
          bindActions: function() {
            var self = this,
                selectors = this.getSelectors();

            this.$wrapper.on('click', selectors.triggerAdd, function(e) {
              e.preventDefault();
              self.appendFieldsGroup( this );
              return false;
            }).on('click', selectors.triggerRemove, function(e) {
              e.preventDefault();
              self.removeFieldsGroup( this );
              return false;
            }).on('click', selectors.triggerUndo, function(e) {
              e.preventDefault();
              self.appendFieldsGroup( this, window.productAddSaleFieldsSafeData );
              return false;
            });

            return this;
          }
        } )).init( this, options )
      }
    },

    /**
     * editPrice on ProductController@index route
     * @param  {object} options
     */
    editPrice: function( options ) {
      return {
        editPrice: Object.create($.extend(true, Helper, {
          options: {
            ajax: {
              url: null
            },
            selectors: (function() {
              var prefix = '.hs-product-edit-price';

              return {
                wrapper: prefix,
                trigger: prefix + '-trigger',
                form:    prefix + '-form',
                input:   prefix + '-input',
                submit:  prefix + '-submit',
                loading: prefix + '-loading',
                cancel:  prefix + '-cancel',
                popover: prefix + '-popover',
                actions: {
                  active: 'active',
                  danger: 'ls-background-danger',
                }
              }
            })()
          },
          getSelectors: function() {
            return this.options.selectors;
          },
          init: function( elem, options ) {
            this.extendOptions( options );

            var selectors = this.getSelectors();

            this.$wrapper = $( elem );
            this.$popover = this.$wrapper.children( selectors.popover );
            this.$trigger = this.$wrapper.children( selectors.trigger );
            this.$form    = this.$wrapper.children( selectors.form );
            this.$input   = this.$form.children( selectors.input );
            this.button   = {
              $loading: this.$form.children( selectors.loading ),
              $submit:  this.$form.children( selectors.submit ),
              $cancel:  this.$form.children( selectors.cancel )
            };

            this.currentPrice = this.oldPrice = this.$input.val().replace('.', ',');

            this.bindActions();

            return this;
          },
          showInput: function() {
            var selectors = this.getSelectors(),
                $activeWrappers = $( selectors.wrapper + '.' + selectors.actions.active );

            $activeWrappers.removeClass( selectors.actions.active );
            $activeWrappers.find( selectors.form ).hide();
            $activeWrappers.find( selectors.input ).removeClass( selectors.actions.danger );
            $activeWrappers.find( selectors.trigger ).show();

            this.$trigger.hide();
            this.$form.show();
            this.$input.focus();

            this.$wrapper.addClass( selectors.actions.active );

            return this;
          },
          hideInput: function() {
            this.$input
              .val( this.currentPrice )
              .trigger('keyup')
              .removeClass('ls-background-danger');

            this.$form.hide();
            this.$trigger.show();

            this.$wrapper.removeClass( this.options.selectors.actions.active );

            return this;
          },
          showWitchInput: function(nextOrPrev) {
            var index,
                witchWrapper,
                allWrappers = $( this.options.selectors.wrapper ),
                currentWrapperIndex = allWrappers.index( this.$wrapper[0] );

            if (nextOrPrev === 'next') {
              index = 1;
            } else if(nextOrPrev === 'prev')  {
              index = -1;
            }

            witchWrapper = allWrappers.eq( currentWrapperIndex + index );

            if ( currentWrapperIndex + index >= 0 && witchWrapper.length ) {
              witchWrapper.data('product').editPrice.showInput();
              return witchWrapper.data('product').editPrice;
            } else {
              this.showInput();
              return this;
            }
          },
          showPopover: function(data) {
            if ($.isArray(data) && data[0] && data[1]) {
              this.$popover.data('title', data[0]).data('content', data[1]);

              locastyle.popover.destroy();
              locastyle.popover.init();
              locastyle.popover.show( this.$popover.data('target') );
            }

            return this;
          },
          hidePopover: function() {
            this.$popover
              .data('title', '')
              .data('content', '');

            locastyle.popover.hide( this.$popover.data('target') );
            locastyle.popover.destroy();

            return this;
          },
          cleanPopover: function() {
            this.$popover.data('title', '').data('content', '');

            return this;
          },
          onSuccess: function( data ) {
            this.showPopover(['Sucesso!', 'Preço alterado com sucesso!']);
            this.$trigger.text( 'R$ ' + this.currentPrice );
            this.hideInput();

            return this;
          },
          onError: function( data ) {
            this.$input.addClass('ls-background-danger').focus();
            this.showPopover(['Erro!', data.status.error]);

            this.currentPrice = this.oldPrice.replace('.', ',');

            return this;
          },
          onBeforeSend: function() {
            this.cleanPopover();

            this.button.$submit.hide();
            this.button.$cancel.hide();
            this.button.$loading.show();

            return this;
          },
          onComplete: function() {
            var self = this;

            self.button.$loading.hide();
            self.button.$submit.show();
            self.button.$cancel.show();

            setTimeout(function() {
              self.hidePopover();
            }, 5000);

            return this;
          },
          checkData: function( data ) {
            var buildUl = function( content ) {
              if ($.isPlainObject(content) || $.isArray(content)) {
                var ul = $('<ul></ul>');
                $.each( content, function(k, val) {
                  ul.append('<li>' + buildUl(val) + '</li>')
                });
                return ul.html();
              } else {
                return content;
              }
            };

            if (typeof data === 'object' && typeof data.status === 'object' && (data.status.hasOwnProperty('success') || data.status.hasOwnProperty('error')) ) {
              data.status.error   = data.status.hasOwnProperty('error')   ? buildUl( data.status.error )   : false;
              data.status.success = data.status.hasOwnProperty('success') ? buildUl( data.status.success ) : false;

              return data;
            }

            return {
              status: {
                success: false,
                error: 'Houve um problema na validação dos dados!'
              }
            };
          },
          submitPrice: function() {
            var data, self = this;

            self.currentPrice = self.$input.val().replace('.', ',');

            if (self.oldPrice == self.currentPrice) {
              self.hideInput();

              return this;
            }

            $.ajax({
              type: 'post',
              url: self.options.ajax.url || self.$form.data('url'),
              data: self.$form.children(':input').serialize(),
              beforeSend: function() {
                self.onBeforeSend();
              },
              success: function( XHRData ) {
                data = self.checkData( XHRData );

                if ( data.status.success ) {
                  self.onSuccess( data );
                } else {
                  self.onError( data );
                }
              },
              error: function() {
                self.onError({
                  status: {
                    error: 'Houve um problema ao se comunicar com o sistema via XHR, tente novamente.'
                  }
                });
              },
              complete: function() {
                self.onComplete();
              }
            });
          },
          bindActions: function() {
            var self      = this,
                selectors = this.getSelectors();

            self.$wrapper.on('click', selectors.trigger, function(e) {
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

            }).on('keypress', selectors.input, function(e) {
              // ENTER key only works on keypress event
              var keyCode = e.keyCode || e.which;
              if (keyCode == 13) {
                self.submitPrice();
                return false;
              }
            }).on('keydown', selectors.input, function(e) {
              // TAB key only works on keydown event
              var keyCode = e.keyCode || e.which;
              if (keyCode == 9) {
                self.hideInput();
                e.shiftKey ? self.showWitchInput('prev') : self.showWitchInput('next');
                return false;
              }
            });

            return this;
          }
        } )).init( this, options )
      };
    }
  };

  $.plugin('product', Product);
})( jQuery, window, document );