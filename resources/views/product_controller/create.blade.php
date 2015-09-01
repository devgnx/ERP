@extends('main')

@section('content')
  <div class="container-fluid">
    <h1 class="ls-title-intro">Novo Produto</h1>
    <div class="col-md-12">
      <form action="" class="ls-form row">
        <fieldset>
          <legend>TESTE :)</legend>
          <label for="ls-label col-md2">
            <b class="ls-label-text">Código</b>
            <input type="text" name="product[code]" placeholder="código do produto" required>
          </label>

          <label for="ls-label col-md4">
            <b class="ls-label-text">Nome</b>
            <input type="text" name="product[name]" placeholder="nome do produto" required>
          </label>
        </fieldset>
      </form>
    </div>
  </div>
@endsection