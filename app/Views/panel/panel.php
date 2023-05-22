<?= $this->extend('default') ?>

<?= $this->section('main') ?>

<?php if (!session()->has('isLoggedIn')): ?>
  <div class="min-w-[400px] p-5 bg-white rounded shadow-md my-4">
    <p class="text-red-500 text-center font-bold">
      No has iniciado sesión
    </p>

    <div class="flex my-3">
      <a href="<?php echo base_url('/') ?>" class="px-3 py-2 text-center bg-blue-500 rounded text-white w-full">
        Iniciar sesión
      </a>
    </div>
  </div>
<?php elseif (isset($route) && !empty($route)): ?>
  <!-- Se muestra de forma dinámica en base a lo que se le pase en la variable '$route' desde el controlador -->
  <?= $this->include($route) ?>
<?php endif ?>

<?= $this->endSection() ?>