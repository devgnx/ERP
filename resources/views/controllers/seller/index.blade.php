@extends('main')

@section('content')
  <div class="container-fluid">
    @include('partials.messages')
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

    @if ($sellers->hasPages())
      <div class="ls-pagination-filter">
        {!! $paginate !!}
      </div>
    @endif
  </div>
@endsection
