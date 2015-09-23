<!DOCTYPE html>
<html lang="en" class="ls-theme-light-green">
<head>
  @include('partials.head')
</head>
<body>
  <!--[if lt IE 10]>
    <p class="browsehappy">Você está usando um navegador <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/"><strong>Atualize seu navegador</strong></a> para ter uma melhor experiência.</p>
  <![endif]-->

  <div style="height: 0; width: 0; position: absolute; visibility: hidden">
    @include('partials.svgicons')
  </div>

  @include('partials.topbar')

  <main class="ls-main ">
    @yield('content')
  </main>

  @include('partials.sidebar')

  @include('partials.notifications')

  @include('partials.scripts')
</body>
</html>
