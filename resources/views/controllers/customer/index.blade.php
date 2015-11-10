@extends('main')

@section('content')
  <div class="container-fluid">
    @include('partials.messages')
    <table class="ls-table" data-ls-module="form">
      <thead>
        <tr>
          <th>Nome/Email</th>
          <th>Contato</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customers as $customer)
          <tr>
            <td>
              <a href="{{ route('customer.edit', ['id' => $customer->id]) }}">
                <p>{{ $customer->name }}</p>
                <p>{{ $customer->email }}</p>
              </a>
            </td>
            <td>
              <a href="{{ route('customer.edit', ['id' => $customer->id]) }}">
                <p>{{ $customer->phone }}</p>
                <p class="ls-screen-md ls-screen-lg">{{ $customer->address_full }}</p>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    @if ($customers->hasPages())
      <div class="ls-pagination-filter">
        {!! $paginate !!}
      </div>
    @endif
  </div>
@endsection
