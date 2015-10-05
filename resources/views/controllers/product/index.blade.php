@extends('main')

@section('head')
  <link rel="stylesheet" href="{{ url('/') }}/css/product.min.css">
@endsection

@section('content')
  <div class="container-fluid">
    @include('partials.messages')

    <div class="ls-box-filter">
      <form action="{{ route('product.filter') }}" method="get" class="ls-form hs-toggle-view @if ( !empty($filter['category']) ) ls-display-none @endif">
        <div class="hs-product-filter-field ls-form-inline ls-float-right">
          <label class="ls-label" role="search">
            <b class="ls-label-text ls-hidden-accessible">Produto</b>
            <input id="search-product-name" name="filter[product][name]" @if (!empty($filter['product']['name'])) value="{{ $filter['product']['name'] }}" @endif type="text" aria-label="Faça sua busca por produto" placeholder="Nome do produto" class="ls-field">
            <input type="submit" value="Buscar" class="ls-btn" title="Buscar">

            @if (!empty($filter))
              <a href="{{ route('product.index') }}" class="ls-btn-danger ls-ico-close"></a>
            @endif
          </label>
        </div>
      </form>

      <form action="{{ route('product.filter') }}" method="get" class="ls-form">
        <div class="hs-product-filter-buttons">
          <b class="ls-label-text" data-toggle-class="ls-display-none" data-target=".hs-toggle-view">Categorias</b>

          <a href="#" class="hs-toggle-view @if ( !empty($filter['category']) ) ls-display-none @endif ls-btn" title="Mostrar" data-toggle-class="ls-display-none" data-target=".hs-toggle-view">Mostrar</a>
          <a href="#" class="hs-toggle-view @if ( empty($filter['category']) ) ls-display-none @endif ls-btn" title="Esconder" data-toggle-class="ls-display-none" data-target=".hs-toggle-view">Esconder</a>

          <input type="submit" value="Filtrar" class="hs-toggle-view @if ( empty($filter['category']) ) ls-display-none @endif ls-btn" title="Filtrar">

          @if (!empty($filter['category']))
              <a href="{{ route('product.index') }}" class="hs-toggle-view ls-btn-danger ls-ico-close"></a>
            @endif
        </div>

        <div class="hs-toggle-view clearfix ls-label col-md-12 @if ( empty($filter['category']) ) ls-display-none @endif">
          <div style="height:1px;"></div>
          <hr>
          <div class="row">
            @foreach ($categories as $category)
              <label class="ls-label-text col-md-3">
                <input name="filter[category][{{ $category->id }}]" value="{{ $category->id }}" class="ls-field" type="checkbox" @if ( !empty($filter['category'][$category->id]) ) checked @endif> {{ $category->name }}
              </label>
            @endforeach
          </div>
        </div>

      </form>
    </div>

    <table class="ls-table ls-bg-header" data-ls-module="form">
      <thead>
        <tr>
          <th>Produto</th>
          <th><span class="ls-tooltip-top-left" aria-label="Clique sobre o valor para altera-lo">Preço <span class="hs-product-edit-price-info">?</span></span></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $product)
          <tr>
            {{-- <td>
              @if (isset($product->image))
                <img src="{{ $product->image }}">
              @endif
            </td> --}}
            <td>
              <a href="{{ route('product.edit', ['id' => $product->slug]) }}">
                <p>{{ $product->code }}</p>
                <p>{{ $product->name }}</p>
              </a>
            </td>
            <td>
              <div class="hs-product-edit-price">
                <div class="hs-product-edit-price-popover" data-ls-module="popover" data-title="" data-content="" data-placement="left"></div>

                <span class="hs-product-edit-price-trigger">
                  R$ {{ str_replace('.', ',', $product->price) }}
                </span>
                <div class="hs-product-edit-price-form" data-url="{{ route('product.edit.price', $product->slug) }}" style="display:none">
                  R$ <input class="hs-product-edit-price-input ls-mask-money" name="product[{{ $product->id }}][price]" value="{{ $product->price }}">
                  <button class="hs-product-edit-price-loading ls-btn-info ls-ico-spinner" type="button" style="display: none" disabled></button>
                  <button class="hs-product-edit-price-submit ls-btn-primary ls-ico-checkmark" type="submit"></button>
                  <button class="hs-product-edit-price-cancel ls-btn-danger ls-ico-close" type="submit"></button>
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="2">
              <h3>Não há produtos para serem exibidos</h3>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    @if ($products->hasPages())
      <div class="ls-pagination-filter">
        {!! $paginate !!}

        @if (false) {
          <ul class="ls-pagination">
            @if ($products->previousPageUrl())
              <li><a href="{{ $products->previousPageUrl() }}">&laquo; Anterior</a></li>
            @else
              <li><a class="ls-disabled" href="#">&laquo; Anterior</a></li>
            @endif

            @foreach($products->previousLinks() as $page => $link)
              <li><a href="{{ $link }}">{{ $page }}</a></li>
            @endforeach

            <li><a class="active" href="#">{{ $products->currentPage() }}</a></li>

            @foreach($products->nextLinks() as $page => $link)
              <li><a href="{{ $link }}">{{ $page }}</a></li>
            @endforeach

            @if ($products->hasNextAllLinks())
              <li class="hs-next-all">
                <a href="#" data-toggle-class="ls-display-none" data-target=".hs-next-all">
                  <span class="ls-gap ">...</span>
                </a>
              </li>

              @foreach($products->nextAllLinks() as $page => $link)
                <li class="ls-display-none hs-next-all"><a href="{{ $link }}">{{ $page }}</a></li>
              @endforeach
            @endif

            @if ($products->nextPageUrl())
              <li><a href="{{ $products->nextPageUrl() }}">Próximo &raquo;</a></li>
            @else
              <li><a class="ls-disabled" href="">Próximo &raquo;</a></li>
            @endif
          </ul>
        @endif
      </div>
    @endif
  </div>
@endsection


@section('scripts')
  <script src="{{ url('/') }}/js/products.min.js"></script>
@endsection