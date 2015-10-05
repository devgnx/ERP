@extends('main')

@section('content')
  <div class="container-fluid">
    @include('partials.messages')
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

    <div class="ls-pagination-filter">
      <ul class="ls-pagination">
        <li><a href="#">&laquo; Anterior</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><span class="ls-gap">...</span></li>
        <li><a href="#">Próximo &raquo;</a></li>
      </ul>
    </div>
  </div>
@endsection