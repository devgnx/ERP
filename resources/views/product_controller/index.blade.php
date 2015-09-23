@extends('main')

@section('head')
  <link rel="stylesheet" href="{{ url('/') }}/css/product.min.css">
@endsection

@section('content')
  <div class="container-fluid">
    @include('partials.messages')
    <table class="ls-table" data-ls-module="form">
      <tbody>
        @foreach($products as $product)
          <tr>
            {{-- <td>
              @if (isset($product->image))
                <img src="{{ $product->image }}">
              @endif
            </td> --}}
            <td>
              <a href="{{ route('product.edit', ['id' => $product->slug]) }}">
                <div>{{ $product->code }}</div>
                <div>{{ $product->name }}</div>
              </a>
            </td>
            <td>
              <div class="edit-price">
                <span class="edit-price-trigger">
                  R$ {{ str_replace('.', ',', $product->price) }}
                </span>
                <div class="edit-price-form" data-url="{{ route('product.edit.price', $product->slug) }}" style="display:none">
                  R$ <input class="edit-price-input ls-mask-money" name="product[{{ $product->id }}][price]" value="{{ $product->price }}">
                  <button class="edit-price-submit ls-btn-primary ls-ico-checkmark" type="submit"></button>
                  <button class="edit-price-cancel ls-btn-danger ls-ico-close" type="submit"></button>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection


@section('scripts')
  <script src="{{ url('/') }}/js/products.min.js"></script>
@endsection