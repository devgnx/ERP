@extends('main')

@section('content')
  <div class="container-fluid">
    @include('partials.messages')

     <div class="ls-box-filter">
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
    </div>

    <table class="ls-table" data-ls-module="form">
      <thead>
        <tr>
          <th>Fornecedor</th>
          <th>Telefone/Endereço</th>
        </tr>
      </thead>
      <tbody>
        @foreach($suppliers as $supplier)
          <tr>
            <td>
              <a href="{{ route('supplier.edit', ['id' => $supplier->slug]) }}">
                <p>{{ $supplier->name }}</p>
                <p>{{ $supplier->email }}</p>
              </a>
            </td>
            <td>
              <p>{{ $supplier->phone }}</p>
              <p>{{ $supplier->address }}</p>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    @if ($suppliers->hasPages())
      <div class="ls-pagination-filter">
        {!! $paginate !!}
      </div>
    @endif
  </div>
@endsection