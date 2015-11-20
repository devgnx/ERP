<script id="hs-create-customer-modal-steps-template" type="text/x-handlebars-template">
  <div class="ls-steps">
    <div class="ls-steps-mobile">
      <a class="ls-steps-mobile-btn ls-ico-chevron-down"></a>
    </div>
    <ol class="ls-steps-nav">
      <li>
        <button class="ls-steps-btn" data-ls-module="steps" data-target="#type" title="Tipo de Comprador"></button>
      </li>
      <li>
        <button class="ls-steps-btn" data-ls-module="steps" data-target="#data" title="Dados do comprador"></button>
      </li>
      <li>
        <button class="ls-steps-btn" data-ls-module="steps" data-target="#result" title="Finalização"></button>
      </li>
    </ol>
    <div class="ls-steps-main">
      <div class="ls-steps-content" id="type">
        <h3 class="ls-title-3">Escolha o tipo da pessoa do comprador</h3>
        <label for="#hs-create-customer-type-person" class="ls-btn ls-btn-lg ls-primary" data-action="next" type="button">Física</label>
        <label for="#hs-create-customer-type-company" class="ls-btn ls-btn-lg ls-primary" data-action="next" type="button">Jurídica</label>
        <input id="hs-create-customer-type-person" name="hs-create-customer-type" value="person" type="radio">
        <input id="hs-create-customer-type-company" name="hs-create-customer-type" value="company" type="radio">
      </div>
      <div class="ls-steps-content" id="data">
        <div class="hs-create-customer-fields-container"></div>
        <div class="ls-actions-btn">
          <a href="#" class="ls-btn" data-action="prev">Anterior</a>
          <a href="#" class="ls-btn-primary ls-float-right" data-action="next">Próximo</a>
        </div>
      </div>
      <div class="ls-steps-content" id="result">
        <div class="hs-create-customer-result-status-sending">Enviando!</div>
        <div class="hs-create-customer-result-status-success">Sucesso!</div>
        <div class="hs-create-customer-result-status-failure">Erro!</div>
        <div class="ls-actions-btn">
          <a href="#" class="ls-btn" data-action="prev">Anterior</a>
          <a href="#" class="ls-btn-primary ls-float-right">Finalizar</a>
        </div>
      </div>
    </div>
  </div>
</script>

<script id="hs-create-customer-person-template" type="text/x-handlebars-template">
  <fieldset>
    <label class="ls-label col-md-5">
      <b class="ls-label-text">Nome</b>
      <input name="customer[name]" value="{{ old('customer.name') }}" class="ls-field" type="text" required>
    </label>

    <label class="ls-label col-md-4">
      <b class="ls-label-text">Email</b>
      <input name="customer[email]" value="{{ old('customer.email') }}" class="ls-field" type="email">
    </label>

    <label class="ls-label col-md-6">
      <b class="ls-label-text">CPF</b>
      <input name="customer[cpf]" value="{{ old('customer.cpf') }}" class="ls-mask-cpf ls-field" type="text" required>
    </label>

    <label class="ls-label col-md-4">
      <b class="ls-label-text">Tipo</b>
      <div class="ls-custom-select">
        <select class="ls-select">
          <option> Nenhum </option>
          @foreach ($customer_types as $type)
            <option value="{{ $type->id }}"> {{ $type->name }} </option>
          @endforeach
        </select>
      </div>
    </label>
  </fieldset>
</script>

<script id="hs-create-customer-company-template" type="text/x-handlebars-template">
  <fieldset>
    <label class="ls-label col-md-5">
      <b class="ls-label-text">Nome Fantasia</b>
      <input name="customer[name]" value="{{ old('customer.name') }}" class="ls-field" type="text" required>
    </label>

    <label class="ls-label col-md-5">
      <b class="ls-label-text">Razão Social</b>
      <input name="customer[company][name]" value="{{ old('customer.company.name') }}" class="ls-field" type="text" required>
    </label>

    <label class="ls-label col-md-4">
      <b class="ls-label-text">Email</b>
      <input name="customer[email]" value="{{ old('customer.email') }}" class="ls-field" type="email">
    </label>

    <label class="ls-label col-md-6">
      <b class="ls-label-text">CNPJ</b>
      <input name="customer[company][cnpj]" value="{{ old('customer.company.cnpj') }}" class="ls-mask-cpf ls-field" type="text" required>
    </label>

    <label class="ls-label col-md-4">
      <b class="ls-label-text">Tipo</b>
      <div class="ls-custom-select">
        <select class="ls-select">
          <option> Nenhum </option>
          @foreach ($customer_types as $type)
            <option value="{{ $type->id }}"> {{ $type->name }} </option>
          @endforeach
        </select>
      </div>
    </label>
  </fieldset>
</script>

<script id="hs-product-sale-fields-template" type="text/x-handlebars-template">
  <div class="hs-product-sale-fields-group ls-clearfix">
    <hr class="ls-clear-both">

    <label class="ls-label col-sm-12 col-md-5">
      <b class="ls-label-text">Produto</b>
      <div class="ls-prefix-group">
        <input class="hs-product-load-name ls-field" data-url="{{ route('product.load') }}" type="text" required>
        <input name="sale[products][id][]" class="hs-product-load-id ls-field" type="hidden" required>
        <a href="#" class="ls-label-text-prefix ls-ico-search"></a>
      </div>
    </label>
    <label class="hs-quantity-field-container ls-label col-sm-4 col-md-2">
      <b class="ls-label-text">Quantidade</b>
      <div class="hs-number-container ls-prefix-group">
        <a href="#" class="hs-number-less ls-label-text-prefix ls-bg-white">-</a>
        <input name="sale[products][quantity][]" class="hs-product-load-quantity ls-field ls-txt-center ls-no-spin" value="1" type="number" data-min="1" required>
        <a href="#" class="hs-number-more ls-label-text-prefix ls-bg-white">+</a>
      </div>
    </label>
    <label class="hs-price-field-container ls-label col-sm-4 col-md-2">
      <b class="ls-label-text">Preço</b>
      <input class="hs-product-load-price ls-field ls-mask-money" type="text" placeholder="0,00" disabled>
    </label>
    <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-add ls-float-left" title="Adicionar Produto">
      <b class="ls-label-text ls-hidden-accessible">Adicionar Produto</b>
      <svg class="hs-svg-icon"><use xlink:href="#icon-plus4" /></svg>
    </a>
    <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-remove ls-float-left" title="Remover Produto">
      <b class="ls-label-text ls-hidden-accessible">Remover Produto</b>
      <svg class="hs-svg-icon"><use xlink:href="#icon-cancel2" /></svg>
    </a>
    <a href="#" class="hs-product-sale-fields-trigger hs-product-sale-fields-undo ls-float-left" title="Desfazer">
      <b class="ls-label-text ls-hidden-accessible">Desfazer</b>
      <svg class="hs-svg-icon"><use xlink:href="#icon-reply2" /></svg>
    </a>
  </div>
</script>
