<!DOCTYPE html>
<html lang="en" class="ls-theme-light-green">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $main->title }}</title>

  <!-- build:css css/app.min.css -->
  <link rel="stylesheet" href="lib/normalize-css/dist/normalize.css">
  <link rel="stylesheet" href="lib/locawebstyle/dist/stylesheets/locastyle.css" >
  <link rel="stylesheet" href="css/app.css">
  <!-- endbuild -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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

  <aside class="ls-sidebar">
    <!-- Defails of user account -->
    <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
      <a href="#" class="ls-ico-user">
        Emma Bender
        <small>(lstyle)</small>
      </a>
      <nav class="ls-dropdown-nav ls-user-menu">
        <ul>
          <li><a href="#">submenu</a></li>
        </ul>
      </nav>
    </div>

    @include('includes/navbar')
  </aside>

  <aside class="ls-notification">
    <nav class="ls-notification-list" id="ls-notification-curtain" style="left: 1716px;">
      <h3 class="ls-title-2">Notificações</h3>
      <ul>
        <li class="ls-dismissable">
          <a href="#">Blanditiis est est dolorem iure voluptatem eos deleniti repellat et laborum consequatur</a>
          <a href="#" data-ls-module="dismiss" class="ls-ico-close ls-close-notification"></a>
        </li>
        <li class="ls-dismissable">
          <a href="#">Similique eos rerum perferendis voluptatibus</a>
          <a href="#" data-ls-module="dismiss" class="ls-ico-close ls-close-notification"></a>
        </li>
        <li class="ls-dismissable">
          <a href="#">Qui numquam iusto suscipit nisi qui unde</a>
          <a href="#" data-ls-module="dismiss" class="ls-ico-close ls-close-notification"></a>
        </li>
        <li class="ls-dismissable">
          <a href="#">Nisi aut assumenda dignissimos qui ea in deserunt quo deleniti dolorum quo et consequatur</a>
          <a href="#" data-ls-module="dismiss" class="ls-ico-close ls-close-notification"></a>
        </li>
        <li class="ls-dismissable">
          <a href="#">Sunt consequuntur aut aut a molestiae veritatis assumenda voluptas nam placeat eius ad</a>
          <a href="#" data-ls-module="dismiss" class="ls-ico-close ls-close-notification"></a>
        </li>
      </ul>
    </nav>

    <nav class="ls-notification-list" id="ls-help-curtain" style="left: 1756px;">
      <h3 class="ls-title-2">Feedback</h3>
      <ul>
        <li><a href="#">&gt; quo fugiat facilis nulla perspiciatis consequatur</a></li>
        <li><a href="#">&gt; enim et labore repellat enim debitis</a></li>
      </ul>
    </nav>

    <nav class="ls-notification-list" id="ls-feedback-curtain" style="left: 1796px;">
      <h3 class="ls-title-2">Ajuda</h3>
      <ul>
        <li class="ls-txt-center hidden-xs">
          <a href="#" class="ls-btn-dark ls-btn-tour">Fazer um Tour</a>
        </li>
        <li><a href="#">&gt; Guia</a></li>
        <li><a href="#">&gt; Wiki</a></li>
      </ul>
    </nav>
  </aside>

  <!-- build:js js/app.min.js -->
  <script src="lib/jquery/dist/jquery.min.js"></script>
  <script src="lib/locawebstyle/dist/javascripts/locastyle.js"></script>
  <script src="js/app.js"></script>
  <!-- endbuild -->
</body>
</html>
