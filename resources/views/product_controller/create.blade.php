@extends('main')

@section('content')
  <div class="container-fluid">
    <h1 class="ls-title-intro">Novo Produto</h1>
    <div class="col-md-12">
      <form action="{{ route('product.store', ['id' => $product->slug]) }}" data-ls-module="form" class="ls-form row">
        <div class="row">
          <label class="ls-label col-md-6">
              <span class="ls-label-text">Nome</span>
              <input type="text" name="product[name]">
          </label>
          <label class="ls-label col-md-6">
              <span class="ls-label-text">Código</span>
              <input name="product[code]" type="text">
          </label>
          <label class="ls-label col-md-6">
              <span class="ls-label-text">Preço</span>
              <input name="product[price]" class="ls-mask-money" type="text" placeholder="0,00">
          </label>
        </div>

        @if ($product->stock)
          <div class="row"></div>
        @endif

        @if ($product->categories)
          <div class="row"></div>
        @endif

        <div class="row"></div>
      </form>
    </div>
  </div>
@endsection