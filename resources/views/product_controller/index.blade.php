@extends('main')

@section('content')
  <div class="container-fluid">
    @if (session('messages.products.status'))
      @if (session('messages.products.status.success'))
        <div class="ls-alert-success"><strong>Sucesso!</strong> {{ session('messages.products.status.success') }}!</div>
      @endif

      @if (session('messages.products.status.info'))
        <div class="ls-alert-info"><strong>Atenção:</strong> {{ session('messages.products.status.info') }}</div>
      @endif

      @if (session('messages.products.status.warning'))
        <div class="ls-alert-warning"><strong>Cuidado:</strong> {{ session('messages.products.status.warning') }}</div>
      @endif

      @if (session('messages.products.status.danger'))
        <div class="ls-alert-danger"><strong>Vish!</strong> {{ session('messages.products.status.danger') }}</div>
      @endif
    @endif
    <table class="ls-table">
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>
              @if (isset($product->image))
                <img src="{{ $product->image }}">
              @endif
            </td>
            <td>
              <div>{{ $product->code }}</div>
              <div>{{ $product->name }}</div>
            </td>
            <td>
              <div class="edit-price">
                <span class="edit-price--trigger">{{ $product->price }}</span>
                <div class="edit-price--form" data-url="{{ route('product.edit.price', $product->slug) }}" style="display:none">
                  <input class="edit-price--input" name="product[{{ $product->id }}][price]" value="{{ $product->price }}">
                  <button class="edit-price--submit" type="submit">Salvar</button>
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
  <script src="lib/app/products.js"></script>
  <script src="js/products.js"></script>
@endsection