<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de control</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/default.css'); ?>">
</head>

<body>
  <div class="wrapper">
    <nav class="nav w-full flex justify-between text-white">
      <?php if (session()->get('isLoggedIn')): ?>
        <div class="flex items-center justify-center">
          <h3 class="text-white text-xl font-bold mx-3">
            Hola,
            <?= session()->get('user') ?>
          </h3>

          <div class="mx-2 h-full bg-white flex items-stretch mx-[2rem]">
            <a href="<?php echo base_url('/') ?>"
                class="bg-black text-indigo-300 px-5 flex items-center hover:bg-indigo-500 hover:text-white font-bold">Inicio</a>
            <a href="<?php echo base_url('/documents') ?>"
                class="bg-black text-indigo-300 px-5 flex items-center hover:bg-indigo-500 hover:text-white font-bold">Crear
              archivos word, excel y pdf</a>
            <a href="<?php echo base_url('/users') ?>"
                class="bg-black text-indigo-300 px-5 flex items-center hover:bg-indigo-500 hover:text-white font-bold">Tabla de usuarios</a>
          
             </div>
        </div>

        <div class="flex items-center justify-center">
          <form action="auth/logout" method="post">
            <input type="submit" class="mx-3 rounded bg-red-600 text-red-200 p-2 font-bold" value="Cerrar sesión" />
          </form>
        </div>

      <?php else: ?>
        <div class="flex items-center justify-center">
          <h3 class="font-bold text-white mx-3">Sistema gestor de archivos</h3>
        </div>
      <?php endif; ?>
    </nav>

    <main class="main">
      <?php if (session()->has('message')): ?>
        <div class="min-w-[400px] p-5 bg-white rounded shadow-md my-4">
          <p class="text-green-500 text-center font-bold">
            <?php echo session('message'); ?>
          </p>
        </div>
      <?php elseif (session()->has('error')): ?>
        <div class="min-w-[400px] p-5 bg-white rounded shadow-md my-4">
          <p class="text-red-500 text-center font-bold">
            <?php echo session('error'); ?>
          </p>
        </div>
      <?php endif ?>

      <?= $this->renderSection('main') ?>
    </main>

    <footer class="footer flex justify-end items-center">
      <p class="text-white">Todos los derechos reservados &copy;</p>
    </footer>
  </div>
</body>

</html>