;(function ( $, window, document, undefined ) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  /**
   * Start jQuery Boilerplate
   */
  // Object.create support test, and fallback for browsers without it
  if ( typeof Object.create !== "function" ) {
    Object.create = function (o) {
      function F() {}
      F.prototype = o;
      return new F();
    };
  }

  $.plugin = function( name, object ) {
    $.fn[name] = function( options ) {
      return this.each(function() {
        if ( ! $.data( this, name ) ) {
          $.data( this, name, Object.create(object).init(
          options, this ) );
        }
      });
    };
  }

  // End jQuery Boilerplate
})( jQuery, window, document );