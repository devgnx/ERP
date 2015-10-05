@extends('main')

@section('head')
  <link rel="stylesheet" href="{{ url('/') }}/css/product.min.css">
@endsection

@section('content')
  <div class="container-fluid">
    <h1 class="ls-title-intro">Editar produto</h1>
    @include('partials.messages')
    @yield('before-form')

    <div class="ls-box">
      <header class="ls-info-header">
        <h2 class="ls-title-3 col-md-4 ls-ico-origins">
          Produto
          <small>cadastrado em {{ $product->created_at->format('d/m/Y') }}</small>
        </h2>
        <div class="ls-actions-btn ls-float-right">
          <a id="products-form-enable-trigger" href="#" class="ls-btn-primary" data-ls-fields-enable="#products-form" data-toggle-class="ls-display-none" data-target=".product-actions" class="product-actions">Editar</a>
          <div data-ls-module="dropdown" class="ls-dropdown ls-pos-right">
            <a href="#" class="ls-btn"></a>
            <ul class="ls-dropdown-nav">
              <li><a href="#" data-ls-module="modal" data-target="#editPassword">Adicionar ao carrinho de vendas</a></li>
              <li><a href="{{ route('product.destroy') }}">Desativar</a></li>
            </ul>
          </div>
        </div>
      </header>

      <form action="{{ route('product.update', ['id' => $product->slug]) }}" data-ls-module="form" class="ls-form ls-form-horizontal row" method="post">
        {{ csrf_field() }}
        <fieldset id="products-form" class="ls-form-disable ls-form-text">
          <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Nome</b>
            <input name="product[name]" class="ls-field" value="{{ $product->name }}" type="text" required>
          </label>
          <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Código</b>
            <input name="product[code]" class="ls-field" value="{{ $product->code }}" type="text" required>
          </label>
          <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Preço</b>
            <input name="product[price]" class="ls-field ls-mask-money" value="{{ $product->price }}" type="text" placeholder="0,00">
          </label>

          @if ($product->stock)
            <label class="ls-label col-md-6 col-lg-8">
              <b class="ls-label-text">Estoque</b>
              <input name="stock[quantity]" class="ls-field" value="{{ $product->stock->quantity }}" type="text">
            </label>
          @endif
          @if ($product->categories)
            <hr>
            <div class="ls-label col-md-12">
              <p><b>Categorias</b></p>

              <div class="row">
                @foreach ($categories as $category)
                  <label class="hs-product-category-label ls-label-text col-md-3">
                    <input name="category[{{ $category->id }}]" class="ls-field" type="checkbox" @if ( $product->hasCategory($category->id) ) checked @endif> {{ $category->name }}
                  </label>
                @endforeach
              </div>
            </div>
          @endif
        </fieldset>

        <div class="product-actions ls-display-none">
          <button type="submit" class="ls-btn-primary">Salvar</button>
          <button class="ls-btn" data-ls-fields-enable="#products-form" data-toggle-class="ls-display-none" data-target=".product-actions" >Cancelar</button>
        </div>
      </form>
    </div>
  </div>
@endsection