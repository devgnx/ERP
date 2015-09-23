<nav class="ls-menu">
  <ul>
    <li><a href="{{ route('home') }}" class="ls-ico-home">Página inicial</a></li>
    <li>
        <a href="#">
            {{-- <svg class="svg-icon"><use xlink:href="#shape-box4" /></svg> --}}
            Gerenciamento de Produtos
        </a>
        <ul>
            <li><a href="{{ route('product.index') }}">Produtos</a></li>
            <li><a href="{{ route('product.index') }}">Estoque</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('seller.index') }}">
            Vendedores
        </a>
    </li>
    <!-- <li><a href="{{ $main->menu->home }}" class="ls-ico-home">Página inicial</a></li>
    <li><a href="{{ $main->menu->home }}" class="ls-ico-home">Página inicial</a></li>
    <li><a href="{{ $main->menu->home }}" class="ls-ico-home">Página inicial</a></li>
    <li><a href="{{ $main->menu->home }}" class="ls-ico-home">Página inicial</a></li>
    <li><a href="{{ $main->menu->home }}" class="ls-ico-home">Página inicial</a></li> -->
  </ul>
</nav>