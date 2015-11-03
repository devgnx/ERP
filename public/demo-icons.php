<?php
$resources_path = __DIR__ . '/../resources';
$svg_path = $resources_path . '/assets/svg/icons/*.svg';
?>

<!DOCTYPE html>
<html lang="en" class="ls-main-full ls-theme-light-green">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Demo Icons</title>

  <link rel="stylesheet" href="css/app.min.css">
  <link rel="stylesheet" href="css/demo-icons.min.css">

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

  <div style="height: 0; width: 0; position: absolute; visibility: hidden">
  <?php include($resources_path . '/views/partials/svgicons.blade.php'); ?>
  </div>

  <div class="ls-topbar">

    <span class="ls-show-sidebar ls-ico-menu"></span>

    <h1 class="ls-brand-name">
      <a class="ls-ico-earth" href="/">
        Voltar ao site
      </a>
    </h1>
  </div>
  <main class="ls-main">
    <div class="container-fluid">
      <div class="hs-demo-icons row">
        <?php foreach(glob($svg_path) as $icon_name): ?>
          <div class="hs-demo-icon-item col-md-2">
            <svg class="hs-svg-icon"><use xlink:href="#icon-<?php echo basename($icon_name, '.svg'); ?>" /></svg>
            <p>icon-<?php echo basename($icon_name, '.svg'); ?></p>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </main>
</body>
</html>
