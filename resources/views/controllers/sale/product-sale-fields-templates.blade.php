<script id="hs-product-sale-fields-template" type="text/x-handlebars-template">
  <div class="hs-product-sale-fields-group ls-clearfix">
    <hr class="ls-clear-both">

    <label class="ls-label col-sm-12 col-md-5">
      <b class="ls-label-text">Produto</b>
      <div class="ls-prefix-group">
        <input class="hs-product-load-name ls-field" data-url="{{ route('product.load') }}" type="text" required>
        <input name="sale[products][id][]" class="hs-product-load-id ls-field" type="hidden" required>
        <a href="#" class="ls-label-text-prefix ls-ico-search"></a>
      </div>
    </label>
    <label class="hs-quantity-field-container ls-label col-sm-4 col-md-2">
      <b class="ls-label-text">Quantidade</b>
      <div class="hs-number-container ls-prefix-group">
        <a href="#" class="hs-number-less ls-label-text-prefix ls-bg-white">-</a>
        <input name="sale[products][quantity][]" class="hs-product-load-quantity ls-field ls-txt-center ls-no-spin" value="1" type="number" data-min="1" required>
        <a href="#" class="hs-number-more ls-label-text-prefix ls-bg-white">+</a>
      </div>
    </label>
    <label class="hs-price-field-container ls-label col-sm-4 col-md-2">
      <b class="ls-label-text">Preço</b>
      <input class="hs-product-load-price ls-field ls-mask-money" type="text" placeholder="0,00" disabled>
    </label>
    <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-add ls-float-left" title="Adicionar Produto">
      <b class="ls-label-text ls-hidden-accessible">Adicionar Produto</b>
      <svg class="hs-svg-icon"><use xlink:href="#icon-plus4" /></svg>
    </a>
    <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-remove ls-float-left" title="Remover Produto">
      <b class="ls-label-text ls-hidden-accessible">Remover Produto</b>
      <svg class="hs-svg-icon"><use xlink:href="#icon-cancel2" /></svg>
    </a>
    <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-undo ls-float-left" title="Desfazer">
      <b class="ls-label-text ls-hidden-accessible">Desfazer</b>
      <svg class="hs-svg-icon"><use xlink:href="#icon-reply2" /></svg>
    </a>
  </div>
</script>