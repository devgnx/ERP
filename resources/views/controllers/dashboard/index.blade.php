@extends('main')

@section('content')
  <div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-dashboard">
      Dashboard
    </h1>
    <div class="row">
      <div class="ls-box">
        <header class="ls-info-header">
          <h2 class="ls-title-3 col-md-4 ls-ico-cart">
            Vendas
          </h2>
        </header>

        {{--<ul class="ls-tabs-nav" id="sales-charts">
          <li class="ls-active"><a data-ls-module="tabs" href="#sale-product-tab">Produtos</a></li>
          <li><a data-ls-module="tabs" href="#sale-category-tab">Categorias</a></li>
          <li><a data-ls-module="tabs" href="#sale-seller-tab">Vendedor</a></li>
          <li><a data-ls-module="tabs" href="#sale-customer-tab">Clientes</a></li>
        </ul>
        <div class="ls-tabs-container" id="sale-charts-container">
          <div id="sale-product-tab" class="ls-tab-content ls-active">
            <div id="sale-product-chart"></div>
          </div>
          <div id="sale-category-tab" class="ls-tab-content">
            <div id="sale-category-chart"></div>
          </div>
          <div id="sale-seller-tab" class="ls-tab-content">
            <div id="sale-seller-chart"></div>
          </div>
          <div id="sale-customer-tab" class="ls-tab-content">
            <div id="sale-customer-chart"></div>
          </div>
        </div>--}}

          <div id="sale-sale-chart"></div>
          <hr class="ls-md-space">
          <div id="sale-category-chart"></div>
          <hr class="ls-md-space">
          <div id="sale-customer-chart"></div>
          <hr class="ls-md-space">
          <div id="sale-product-chart"></div>
          <hr class="ls-md-space">
          <div id="sale-seller-chart"></div>
          <hr class="ls-md-space">

      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script> window.dashboardData = {!! $dashboardData !!}; </script>
  <script src="{{ url('/js/dashboard.min.js') }}"></script>
@endsection