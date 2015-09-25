;(function ( $, window, document, undefined ) {

  $('body').on('modal:opened', id, function(evt, button){
    console.log(evt, button, this);
  });
})( jQuery, window, document );