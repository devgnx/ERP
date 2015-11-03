<!DOCTYPE html>
<html lang="en" class="ls-theme-light-green">
<head>
  @include('partials.head')
  <link rel="stylesheet" href="{{ url('/') }}/css/login.min.css">
</head>
<body>
  <!--[if lt IE 10]>
    <p class="browsehappy">Você está usando um navegador <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/"><strong>Atualize seu navegador</strong></a> para ter uma melhor experiência.</p>
  <![endif]-->

  <div class="ls-login-parent">
    <div class="ls-login-inner">
      <div class="ls-login-container">
        <div class="ls-login-box">
          <h1 class="ls-login-logo">Entrar</h1>
          <form id="login-form" role="form" class="ls-form ls-login-form active" action="{{ route('auth.login') }}" method="post">
            <fieldset>
              @if ( $errors->first('email') )
                <div class="ls-alert-danger">{{ $errors->first('email') }}</div>
              @endif
              {!! csrf_field() !!}

              <label class="ls-label">
                <b class="ls-label-text ls-hidden-accessible">Email</b>
                <input name="email" value="{{ old('email') }}" class="ls-login-bg-user ls-field-lg" type="email" placeholder="Email" required autofocus>
              </label>

              <label class="ls-label">
                <b class="ls-label-text ls-hidden-accessible">Senha</b>
                <div class="ls-prefix-group">
                  <input name="password" id="password_field" class="ls-login-bg-password ls-field-lg" type="password" placeholder="Senha" required>
                  <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field" href="#"></a>
                </div>
              </label>

              <p>
                {{-- <a class="ls-login-forgot" data-toggle-class="active inactive" data-target="#login-form" href="#">Lembrar de mim</a> --}}
                <label class="ls-label hs-login-remember">
                  <input name="remember" value="{{ old('remember') }}" type="checkbox">
                  <span>Lembrar de mim</span>
                </label>
              </p>

              <p><a class="ls-login-forgot" data-toggle-class="active inactive" data-target="#login-form" href="#">Esqueci minha senha</a></p>

              <input type="submit" value="Entrar" class="ls-btn-primary ls-btn-block ls-btn-lg">

            </fieldset>
          </form>

          <form id="reset-password-form" role="form" class="ls-form ls-login-form" action="#">
            <fieldset>
              {!! csrf_field() !!}

              <label class="ls-label">
                <b class="ls-label-text ls-hidden-accessible">Email</b>
                <input name="email" value="{{ old('email') }}" class="ls-login-bg-user ls-field-lg" type="text" placeholder="Email" required autofocus>
              </label>

              <button data-toggle-class="active inactive" data-target="#login-form" class="ls-btn-danger">Cancelar</button>
              <button type="submit" class="ls-btn-primary ls-float-right">Enviar</button>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  @include('partials.scripts')
</body>
</html>