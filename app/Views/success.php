<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>
    <?= $message ?>
  </title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>

<body>
  <header>
    <main>
      <h1>
        <?= $message ?>
      </h1>
      <a id="btn_redirect_to_home">Volver a atrás</a>
    </main>
  </header>

  <script>
    const btnRedirectToHome = document.getElementById('btn_redirect_to_home');
    btnRedirectToHome.addEventListener('click', () => {
      window.history.go(-1);
    });
  </script>
</body>

</html>