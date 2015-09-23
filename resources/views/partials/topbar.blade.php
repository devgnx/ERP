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
        Connor Hawkins
        <small>(lstyle)</small>
      </a>
      <nav class="ls-dropdown-nav ls-user-menu">
        <ul>
          <li><a href="#">Conta</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </div>
  </div>

  <span class="ls-show-sidebar ls-ico-menu"></span>

  <h1 class="ls-brand-name">
    <a class="ls-ico-earth" href="/locawebstyle/documentacao/exemplos/boilerplate">
      {{ $main->nav->title }}
    </a>
  </h1>
</div>

<div id="new-sale-modal" class="ls-modal">
  <div class="ls-modal-box">

    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4 class="ls-modal-title">Nova Venda</h4>
    </div>

    <form action="{{ route('sale.store') }}">
      <div class="ls-modal-body" id="new-sale-modal-body">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row"></div>
        <div class="row"></div>
      </div>

      <div class="ls-modal-footer">
        <button class="ls-btn-primary ls-float-right" type="submit">Salvar</button>
        <button class="ls-btn" data-dismiss="modal">Fechar</button>
      </div>
    </form>

  </div>
</div>