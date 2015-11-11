;(function ( $, window, document, undefined ) {
  $(document).ready(function() {
    if (!!$.fn.product) {
      var $totalPrice = $('.hs-product-sale-total-price'),
          $sellerName = $('.hs-seller-load-name'),
          $sellerId = $('.hs-seller-load-id');

      $('.hs-product-load-name').product('loadProduct');
      $('.hs-product-sale-fields').product('addSaleFields', {
        onAppend: function( instance ) {
          $( this ).find('.hs-product-load-name').product('loadProduct');
        }
      });

      $sellerName.autocomplete({
        serviceUrl: $sellerName.data('url'),
        onSelect: function( value ) {
          $sellerId.val( value.data ).trigger('change');
        }
      });

      $(document).on('change', '.hs-product-load-quantity, .hs-product-load-price', function(e) {
        var total = 0, price, quantity;

        $('.hs-product-sale-fields-group').each(function() {
          price    = Number( $( this ).find('.hs-product-load-price').val().replace(',', '.') );
          quantity = Number( $( this ).find('.hs-product-load-quantity').val() );

          if (! isNaN(price) && ! isNaN(quantity)) {
            total+= ( price * quantity);
          }
        });

        $totalPrice.text( 'R$ ' + number_format(total, 2, ',', '.') );
      });
    }

    var $tableSaleOrder = $('.hs-table-sale-order'),
        $tableSaleOrderItem = $('.hs-table-sale-order-item'),
        $tableSaleOrderItemTrigger = $('.hs-table-sale-order-item-trigger'),
        $body = $('html, body'),
        $currentItem;

    $tableSaleOrder.on('click', '.hs-table-sale-order-item-trigger', function() {
      $currentItem = $(this).parents('.hs-table-sale-order').next().toggleClass('ls-display-none');
      $tableSaleOrderItem.not( $currentItem ).addClass('ls-display-none');

      $body.animate({ scrollTop: $(this).offset().top - 100 });

      $tableSaleOrderItemTrigger.not( this ).removeClass('hs-active');
      $(this).toggleClass('hs-active');
    });
  });
})( jQuery, window, document );
