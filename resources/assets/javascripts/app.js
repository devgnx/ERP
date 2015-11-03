;(function ( $, window, document, undefined ) {

  $( document ).on('click', '.hs-number-container .hs-number-less', function(e) {
    e.preventDefault();
    var input = $(this).siblings('input'),
        value = Number(input.val()) - 1 <= Number(input.data('min')) ? input.data('min') : Number(input.val()) - 1;
    input.val(value).trigger('change');
    return false;

  }).on('click', '.hs-number-container .hs-number-more', function(e) {
    e.preventDefault();
    var input = $(this).siblings('input'),
        value = Number(input.val()) + 1 >= Number(input.data('max')) ? input.data('max') : Number(input.val()) + 1;
    input.val(value).trigger('change');
    return false;
  });

  // End jQuery Boilerplate
})( jQuery, window, document );