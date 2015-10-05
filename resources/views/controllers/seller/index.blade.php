@extends('main')

@section('content')
  <div class="container-fluid">
    @include('partials.messages')
    <a class="btn btn-success" href="{{ route('seller.create') }}">
      {{-- svg icon --}}
      Adicionar Vendedor
    </a>
    <table class="ls-table" data-ls-module="form">
      <thead>
        <tr>
          <th>Código</th>
          <th>Nome</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sellers as $seller)
          <tr>
            <td>
              <a href="{{ route('seller.edit', ['id' => $seller->slug]) }}">
                <p>{{ $seller->code }}</p>
              </a>
            </td>
            <td>
              <a href="{{ route('seller.edit', ['id' => $seller->slug]) }}">
                <p>{{ $seller->name }}</p>
              </a>
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