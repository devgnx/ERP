@extends('main')

@section('styles')
  <link rel="stylesheet" href="{{ url('/css/product.min.css') }}">
@endsection

@section('content')
  <div class="container-fluid">
    <h1 class="ls-title-intro">
      <svg class="hs-svg-icon"><use xlink:href="#icon-banknote"></use></svg>
      Nova Venda
    </h1>

    @include('partials.messages')

    <div class="ls-box">
      <header class="ls-info-header">
        <h2 class="ls-title-3 col-md-4 ls-ico-origins">
          Nova Venda
        </h2>
      </header>

      <form action="{{ route('sale.create') }}" data-ls-module="form" class="hs-product-sale-fields ls-form ls-form-horizontal row" method="post">
        {{ csrf_field() }}
        <fieldset>
          <label class="ls-label col-md-4">
            <b class="ls-label-text">Vendedor</b>
            <div class="ls-prefix-group">
              <input class="hs-seller-load-name ls-field" data-url="{{ route('seller.load') }}" value="{{ $seller->name }}" type="text" required>
              <input class="hs-seller-load-id" name="sale[seller][id]" value="{{ old('seller.id') ?: $seller->id }}" type="hidden" required>
              <a href="#" class="ls-label-text-prefix ls-ico-search"></a>
            </div>
          </label>

          @foreach(is_array(old('product')) ? old('product') : [['id' => '', 'name' => '', 'quantity' => '1', 'price' => '']] as $product)
            <div class="hs-product-sale-fields-group ls-clearfix">
              <hr class="ls-clear-both">

              <label class="ls-label col-sm-12 col-md-5">
                <b class="ls-label-text">Produto</b>
                <div class="ls-prefix-group">
                  <input class="hs-product-load-name ls-field" data-url="{{ route('product.load') }}" value="{{ $product['name'] }}" type="text" required>
                  <input name="sale[products][id][]" class="hs-product-load-id ls-field" value="{{ $product['id'] }}" type="hidden" required>
                  <a href="#" class="ls-label-text-prefix ls-ico-search"></a>
                </div>
              </label>
              <label class="hs-quantity-field-container ls-label col-sm-4 col-md-2">
                <b class="ls-label-text">Quantidade</b>
                <div class="hs-number-container ls-prefix-group">
                  <a href="#" class="hs-number-less ls-label-text-prefix ls-bg-white">-</a>
                  <input name="sale[products][quantity][]" class="hs-product-load-quantity ls-field ls-txt-center ls-no-spin" value="{{ $product['quantity'] }}" type="number" data-min="1" required>
                  <a href="#" class="hs-number-more ls-label-text-prefix ls-bg-white">+</a>
                </div>
              </label>
              <label class="hs-price-field-container ls-label col-sm-4 col-md-2">
                <b class="ls-label-text">Preço</b>
                <input class="hs-product-load-price ls-field ls-mask-money" value="{{ $product['price'] }}" type="text" placeholder="0,00" disabled>
              </label>
              <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-add ls-float-left" title="Adicionar Produto">
                <b class="ls-label-text ls-hidden-accessible">Adicionar Produto</b>
                <svg class="hs-svg-icon"><use xlink:href="#icon-plus4" /></svg>
              </a>
              <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-undo ls-float-left" title="Desfazer">
                <b class="ls-label-text ls-hidden-accessible">Desfazer</b>
                <svg class="hs-svg-icon"><use xlink:href="#icon-reply2" /></svg>
              </a>
            </div>
          @endforeach

          {{-- @foreach(is_array(old('product')) ? old('product') : [['id' => '', 'name' => '', 'quantity' => '1', 'price' => '']] as $product)
            <div class="discount-group">
              <label class="ls-label col-sm-4 col-md-5">
                <b class="ls-label-text">Descontos</b>
                <input class="ls-field" value="{{ $product['name'] }}" type="text" required>
                <input name="sale[discount][]" class="ls-field" value="{{ $product['id'] }}" type="hidden" required>
              </label>
            </div>
          @endforeach --}}
        </fieldset>

        <div class="ls-box">
          {{-- <h4 class="ls-title-3 ls-txt-right">Subtotal</h4>
          <p class="ls-txt-right"></p>

          <hr> --}}

          <h3 class="ls-title-5 ls-txt-right">Total</h3>
          <h4 class="hs-product-sale-total-price ls-title-3 ls-txt-right">R$ 0,00</h4>
        </div>

        <div class="product-actions ls-txt-right">
          <button class="ls-btn-primary" type="submit">Salvar</button>
          <button class="ls-btn" data-ls-fields-enable="#products-form" data-toggle-class="ls-display-none" data-target=".product-actions" >Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  @include('controllers.sale.product-sale-fields-templates')
@endsection

@section('scripts')
  <script src="{{ url('/js/autocomplete.min.js') }}"></script>
  <script src="{{ url('/js/product.lib.min.js') }}"></script>
  <script src="{{ url('/js/sale.min.js') }}"></script>
@endsection