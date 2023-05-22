<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de control</title>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
</head>

<body>
  <div class="wrapper">
    <nav class="nav">
      <!-- <h3 class="nav__title">Panel</h3> -->
      <?php if (session()->get('isLoggedIn')) : ?>
        <a href="<?php echo base_url('/users/logout') ?>" class="nav__link">Cerrar sesión</a>
      <?php else : ?>
        <a href="<?php echo base_url('/users/new') ?>" class="nav__link">Crear cuenta</a>
      <?php endif; ?>
    </nav>