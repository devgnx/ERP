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
                <div>{{ $seller->code }}</div>
              </a>
            </td>
            <td>
              <a href="{{ route('seller.edit', ['id' => $seller->slug]) }}">
                <div>{{ $seller->name }}</div>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection