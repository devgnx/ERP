<div class="ls-topbar">

  <div class="ls-notification-topbar">
    <div class="ls-alerts-list">

      @if ($sales)
        <a href="#"class="ls-ico-cart" data-ls-module="modal" data-target="#new-sale-modal"
          @if($sales->new)
            data-counter="{{ count($sales->new) }}"
          @endif>
          <span>Nova Venda</span>
        </a>
      @endif

      <a href="#" class="ls-ico-bell-o" data-counter="5" data-ls-module="topbarCurtain" data-target="#ls-notification-curtain"><span>Notificações</span></a>
      <a href="#" class="ls-ico-bullhorn" data-ls-module="topbarCurtain" data-target="#ls-help-curtain"><span>Ajuda</span></a>
      <a href="#" class="ls-ico-question" data-ls-module="topbarCurtain" data-target="#ls-feedback-curtain"><span>Sugestões</span></a>
    </div>

    <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
      <a href="#" class="ls-ico-user">
        {{ $user->name }}
      </a>
      <nav class="ls-dropdown-nav ls-user-menu">
        <ul>
          <li><a href="#">Conta</a></li>
          <li><a href="{{ route('auth.logout') }}">Logout</a></li>
        </ul>
      </nav>
    </div>
  </div>

  <span class="ls-show-sidebar ls-ico-menu"></span>

  <h1 class="ls-brand-name">
    <a class="ls-ico-earth" href="/locawebstyle/documentacao/exemplos/boilerplate">
      {{ $store->name }}
    </a>
  </h1>
</div>