@extends('main')

@section('content')
<div class="container-fluid">
  <h1 class="ls-title-intro">Editar vendedor</h1>
  <form action="{{ route('seller.edit', ['id' => $seller->slug]) }}" data-ls-module="form" class="ls-form row">
    <div class="row">
      <label class="ls-label col-md-6">
          <span class="ls-label-text">Nome</span>
          <input type="text" name="seller[name]">
      </label>
      <label class="ls-label col-md-6">
          <span class="ls-label-text">Código</span>
          <input name="seller[code]" type="text">
      </label>
    </div>

    @if ($seller->sales)
      <div class="row"></div>
    @endif

    @if ($seller->history)
      <div class="row"></div>
    @endif
  </form>
</div>
@endsection