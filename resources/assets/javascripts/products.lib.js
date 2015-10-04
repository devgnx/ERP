;(function ( $, window, document, undefined ) {
  "use strict";

  var Product = {
    init: function( options, options2 ) {
      if ( options  && typeof options === "string" && options in this && typeof this[ options ] === "function" ) {
        return this[ options ].apply(this, [options2]);
      } else {
        return this;
      }
    },
    editPrice: function( options ) {
      return {
        editPrice: Object.create( {
          oldPrice: 0,
          currentPrice: 0,
          options: {
            ajax: {
              url: null
            },
            selectors: (function() {
              var prefix = '.edit-price';

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
          init: function( options, wrapper ) {
            $.extend(true, this.options, options || {});

            var selectors = this.options.selectors;

            this.wrapper  = wrapper;
            this.$wrapper = $( wrapper );
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
            var selectors = this.options.selectors,
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
                currentWrapperIndex = allWrappers.index( this.wrapper );

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
          checkData: function( XHRData ) {
            var data = typeof XHRData.data === 'object' ? XHRData.data : null,
                buildUl = function( content ) {
                  if ($.isPlainObject(content) || $.isArray(content)) {
                    var ul = $('<ul></ul>');
                    $.each( content, function(k, val) {
                      ul.append('<li>' + buildUl(val) + '</li>')
                    });
                    return ul.html();
                  } else {
                    return content;
                  }
                }

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
                selectors = this.options.selectors;

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
              // ENTER key only work on keypress event
              var keyCode = e.keyCode || e.which;
              if (keyCode == 13) {
                self.submitPrice();
                return false;
              }
            }).on('keydown', selectors.input, function(e) {
              // TAB key only work on keydown event
              var keyCode = e.keyCode || e.which;
              if (keyCode == 9) {
                self.hideInput();
                e.shiftKey ? self.showWitchInput('prev') : self.showWitchInput('next');
                return false;
              }
            });

            return this;
          }
        }).init( this, options )
      };
    }
  };

  $.plugin('product', Product);
})( jQuery, window, document );