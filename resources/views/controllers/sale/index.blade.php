@extends('main')

@section('styles')
  <link rel="stylesheet" href="{{ url('/css/sale.min.css') }}">
@endsection

@section('content')
  <div class="container-fluid">
    <h1 class="ls-title-intro">
      <svg class="hs-svg-icon"><use xlink:href="#icon-coins" /></svg>
      Histórico de vendas
    </h1>

    @include('partials.messages')

     {{--<div class="ls-box-filter">
      <form action="{{ route('supplier.filter') }}" method="get" class="ls-form hs-toggle-view @if ( !empty($filter['category']) ) ls-display-none @endif">
        <div class="hs-filter-field ls-form-inline ls-float-right">
          <label class="ls-label" role="search">
            <b class="ls-label-text ls-hidden-accessible">Fornecedor</b>
            <input id="search-supplier-name" name="filter[supplier][name]" @if (!empty($filter['supplier']['name'])) value="{{ $filter['supplier']['name'] }}" @endif type="text" aria-label="Faça sua busca por fornecedor" placeholder="Nome do fornecedor" class="ls-field">
            <input type="submit" value="Buscar" class="ls-btn-primary" title="Buscar">

            @if (!empty($filter))
              <a href="{{ route('supplier.index') }}" class="hs-filter-reset ls-btn-danger ls-ico-close"></a>
            @endif
          </label>
        </div>
      </form>

      <form action="{{ route('supplier.filter') }}" method="get" class="ls-form">
        <div class="hs-filter-categories">
          <b class="ls-label-text" data-toggle-class="ls-display-none" data-target=".hs-toggle-view">Categorias</b>

          <a href="#" class="hs-toggle-view @if ( !empty($filter['category']) ) ls-display-none @endif ls-btn" title="Mostrar" data-toggle-class="ls-display-none" data-target=".hs-toggle-view">Mostrar</a>
          <a href="#" class="hs-toggle-view @if ( empty($filter['category']) ) ls-display-none @endif ls-btn" title="Esconder" data-toggle-class="ls-display-none" data-target=".hs-toggle-view">Esconder</a>

          <input type="submit" value="Filtrar" class="hs-toggle-view @if ( empty($filter['category']) ) ls-display-none @endif ls-btn-primary" title="Filtrar">

          @if (!empty($filter['category']))
              <a href="{{ route('supplier.index') }}" class="hs-filter-reset hs-toggle-view ls-btn-danger ls-ico-close"></a>
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
    </div>--}}

    <table class="hs-table-sale-orders ls-table" data-ls-module="form">
      <thead>
        <tr>
          <th>Vendedor</th>
          <th class="ls-display-none-sm ls-display-none-xs">Telefone/Endereço</th>
          <th class="ls-display-none-sm ls-display-none-xs">Status</th>
          <th>Total</th>
          <th class="ls-width-50"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($sales as $key => $order)
          <tr class="hs-table-sale-order">
            <td>
              <a href="{{ route('sale.edit', ['id' => $order->id]) }}" title="Ver venda">
                {{ $order->seller->name }}
              </a>
            </td>
            <td class="ls-display-none-sm ls-display-none-xs">
              <a href="{{ route('customer.edit', ['id' => $order->customer->id]) }}" title="Ver produto">
                <p>{{ $order->customer->phone }}</p>
                <p>{{ $order->shipping->address->full_address }}</p>
              </a>
            </td>
            <td class="ls-display-none-sm ls-display-none-xs">
              ?
            </td>
            <td>R$ {{ $order->total_price }}</td>
            <td>
              <a class="hs-table-sale-order-item-trigger" href="#">
                <svg class="hs-svg-icon"><use xlink:href="#icon-maximize" /></svg>
                <svg class="hs-svg-icon"><use xlink:href="#icon-minimize" /></svg>
              </a>
            </td>
          </tr>
          <tr class="hs-table-sale-order-item ls-display-none">
            <td colspan="5">
              <table class="ls-box">
                <thead>
                  <tr>
                    <th>Produto</th>
                    <th class="ls-width-50">Quantidade</th>
                    <th>Preço</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->items as $item)
                    <tr>
                      <td>
                        <a href="{{ route('product.edit', ['id' => $item->product->slug]) }}">
                          {{ $item->product->name }}
                        </a>
                      </td>
                      <td class="ls-txt-center">{{ $item->quantity }}</td>
                      <td>R$ {{ $item->product_price }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    @if ($sales->hasPages())
      <div class="ls-pagination-filter">
        {!! $paginate !!}
      </div>
    @endif
  </div>


  {{--<div class="ls-modal" id="">
    <div class="ls-modal-box">
      <div class="ls-modal-header">
        <button data-dismiss="modal">&times;</button>
        <h4 class="ls-modal-title">Itens</h4>
      </div>
      <div class="ls-modal-body"></div>
      <div class="ls-modal-footer"></div>
    </div>
  </div>--}}
@endsection

@section('scripts')
  <script src="{{ url('/js/sale.min.js') }}"></script>
@endsection