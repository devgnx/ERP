<!DOCTYPE html>
<html lang="en" class="ls-theme-light-green">
<head>
  @include('partials.head')
</head>
<body>
  <!--[if lt IE 10]>
    <p class="browsehappy">Você está usando um navegador <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/"><strong>Atualize seu navegador</strong></a> para ter uma melhor experiência.</p>
  <![endif]-->

  <div class="ls-topbar">

    <!-- Notification bar -->
    <div class="ls-notification-topbar">
      <!-- Link of support/help -->
      <div class="ls-alerts-list">
        <a href="#" class="ls-ico-bell-o" data-counter="5" data-ls-module="topbarCurtain" data-target="#ls-notification-curtain"><span>Notificações</span></a>
        <a href="#" class="ls-ico-bullhorn" data-ls-module="topbarCurtain" data-target="#ls-help-curtain"><span>Ajuda</span></a>
        <a href="#" class="ls-ico-question" data-ls-module="topbarCurtain" data-target="#ls-feedback-curtain"><span>Sugestões</span></a>
      </div>

      <!-- User details -->
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

    <!-- Nome do produto/marca -->
    <h1 class="ls-brand-name"><a class="ls-ico-earth" href="/locawebstyle/documentacao/exemplos/boilerplate">{{ $main->nav->title }}</a></h1>
  </div>

  <main class="ls-main ">
    @yield('content')
  </main>

  @include('partials.sidebar')

  @include('partials.notifications')

  @include('partials.scripts')
</body>
</html>
