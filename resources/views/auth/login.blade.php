<!DOCTYPE html>
<html lang="en" class="ls-theme-light-green">
<head>
  @include('partials.head')
</head>
<body>
  <!--[if lt IE 10]>
    <p class="browsehappy">Você está usando um navegador <strong>ultrapassado</strong>. Por favor <a href="http://browsehappy.com/"><strong>Atualize seu navegador</strong></a> para ter uma melhor experiência.</p>
  <![endif]-->

{{--
  <div style="height: 0; width: 0; position: absolute; visibility: hidden">
    @include('partials.svgicons')
  </div>
 --}}

  <div class="ls-login-parent">
    <div class="ls-login-inner">
      <div class="ls-login-container">
        <div class="ls-login-box">
          <h1 class="ls-login-logo"><img title="Logo login" src="../../../assets/images/locastyle/logo-locaweb.jpg" /></h1>
          <form role="form" class="ls-form ls-login-form" action="#">
            <fieldset>
              {!! csrf_field() !!}

              <label class="ls-label">
                <b class="ls-label-text ls-hidden-accessible">Usuário</b>
                <input name="email" value="{{ old('email') }}" class="ls-login-bg-user ls-field-lg" type="text" placeholder="Usuário" required autofocus>
              </label>

              <label class="ls-label">
                <b class="ls-label-text ls-hidden-accessible">Senha</b>
                <div class="ls-prefix-group">
                  <input name="password" id="password_field" class="ls-login-bg-password ls-field-lg" type="password" placeholder="Senha" required>
                  <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field" href="#"></a>
                </div>
              </label>

              <p><a class="ls-login-forgot" href="forgot-password">Esqueci minha senha</a></p>

              <input type="submit" value="Entrar" class="ls-btn-primary ls-btn-block ls-btn-lg">

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  @include('partials.scripts')
</body>
</html>