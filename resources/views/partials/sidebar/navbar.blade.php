<nav class="ls-menu">
  <ul>
    <li @if (is_current_route(['home', 'dashboard'])) class="ls-active" @endif><a href="{{ route('dashboard') }}" class="ls-ico-dashboard">Dashboard</a></li>
    <li @if (is_current_route('sale')) class="ls-active" @endif>
      <a href="#" class="ls-ico-cart">
        Vendas
      </a>
      <ul>
        <li @if (is_current_route('sale.create')) class="ls-active" @endif>
          <a href="{{ route('sale.create') }}">
              <svg class="hs-svg-icon"><use xlink:href="#icon-banknote" /></svg>
              Nova Venda
          </a>
        </li>
        <li @if (is_current_route(['sale.index', 'sale.edit'])) class="ls-active" @endif>
          <a href="{{ route('sale.index') }}">
              <svg class="hs-svg-icon"><use xlink:href="#icon-coins" /></svg>
              Histórico de Vendas
          </a>
        </li>
      </ul>
    </li>
    <li @if (is_current_route('product')) class="ls-active" @endif>
      <a href="{{ route('product.index') }}">
        <svg class="hs-svg-icon"><use xlink:href="#icon-box4" /></svg>
        Produtos
      </a>
    </li>
    <li @if (is_current_route('supplier')) class="ls-active" @endif>
      <a href="{{ route('supplier.index') }}">
        <svg class="hs-svg-icon"><use xlink:href="#icon-truck" /></svg> Fornecedores
      </a>
    </li>
    <li @if (is_current_route('seller')) class="ls-active" @endif>
      <a href="{{ route('seller.index') }}">
        <svg class="hs-svg-icon"><use xlink:href="#icon-group" /></svg>
        Vendedores
      </a>
    </li>

    <li @if (is_current_route('customer')) class="ls-active" @endif>
      <a href="{{ route('customer.index') }}">
        <svg class="hs-svg-icon"><use xlink:href="#icon-users" /></svg>
        Clientes
      </a>
    </li>
  </ul>
</nav>
