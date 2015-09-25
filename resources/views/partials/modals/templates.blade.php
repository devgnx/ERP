<script id="new-sale-modal-template" type="text/x-handlebars-template">
  <form action="{{ route('sale.store') }}" method="post">
    <div class="ls-modal-body" id="new-sale-modal-body">
      <div class="row">
        <table class="ls-table">
          <thead>
            <tr>
              <th>Código do vendedor</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <input @if( $seller ) value="{{ $seller->code }}" @endif name="seller[name]" type="text">
                {{-- seller_code ... default_logged seller ... search by name --}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row">
        <table class="ls-table">
          <thead>
            <tr>
              <th>Código</th>
              <th>Quantidade</th>
              <th>Preço</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <input class="ls-tooltip-top" aria-label="Pesquise pelo nome do produto ou código" name="product[code]" type="text" autofocus>
              </td>
              <td><input name="product[quantity]" type="number"></td>
              <td><input disabled name="product[price]" type="number"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="ls-modal-footer">
      <button class="ls-btn-primary ls-float-right" type="submit">Salvar</button>
      <button class="ls-btn" data-dismiss="modal" type="button">Fechar</button>
    </div>
  </form>
</script>