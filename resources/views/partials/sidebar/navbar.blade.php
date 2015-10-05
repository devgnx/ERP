<nav class="ls-menu">
  <ul>
    <li @if (is_current_route('home')) class="ls-active" @endif><a href="{{ route('home') }}" class="ls-ico-home">Página inicial</a></li>
    <li>
        <a href="#">
            {{-- <svg class="svg-icon"><use xlink:href="#shape-box4" /></svg> --}}
            Gerenciamento de Produtos
        </a>
        <ul>
            <li @if (is_current_route(['product.index', 'product.filter'])) class="ls-active" @endif><a href="{{ route('product.index') }}">Produtos</a></li>
            <li @if (is_current_route('supplier.index')) class="ls-active" @endif><a href="{{ route('supplier.index') }}">Fornecedores</a></li>
            <li @if (is_current_route('product.stock')) class="ls-active" @endif><a href="{{ route('product.index') }}">Estoque</a></li>
        </ul>
    </li>
    <li @if (is_current_route('seller.index')) class="ls-active" @endif>
        <a href="{{ route('seller.index') }}">Vendedores</a>
    </li>
  </ul>
</nav>