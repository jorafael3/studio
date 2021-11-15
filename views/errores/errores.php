<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="<?php echo constant('URL') ?>public/css/style404.css">

</head>

<body>
  <div class="noise"></div>
  <div class="overlay"></div>
  <div class="terminal">
    <h1>Error <span class="errorcode">404</span></h1>
    <p class="output">La pagina que estas buscando ha sido removida o no es la correcta.</p>
    <p class="output">Por favor intentelo de nuevo o <a href="<?php echo constant('URL'); ?>">Regresar a la pagina de inicio</a>.</p>
    <p class="output">Buena Suerte</p>
  </div>
</body>

</html>