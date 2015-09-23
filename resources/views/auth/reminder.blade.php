<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Resetar Senha</h2>

    <div>
      Para resetar sua senha, complete este formulário: {{ URL::to('password/reset', array($token)) }}.<br/>
      Este link irá expirar em {{ Config::get('auth.reminder.expire', 60) }} minutos.
    </div>
  </body>
</html>