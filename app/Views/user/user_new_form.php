<?= $this->extend('default') ?>

<?= $this->section('main') ?>
<form action="create" class="min-w-[400px] bg-white p-10 rounded-md shadow-md" method="post">
  <h2 class="font-bold text-xl text-center text-gray-700">Crear cuenta</h2>

  <!-- name -->
  <div class="flex flex-column items-center my-3">
    <label for="name" class="w-4/12 font-bold text-right pr-3">Nombre:</label>
    <input placeholder="Nombre" type="name" class="w-8/12 rounded border-2 border-gray-300 px-3 py-2" name="name"
        required />
  </div>

  <!-- Email -->
  <div class="flex flex-column items-center my-3">
    <label for="email" class="w-4/12 font-bold text-right pr-3">Email:</label>
    <input placeholder="Email" type="email" class="w-8/12 rounded border-2 border-gray-300 px-3 py-2" name="email"
        required />
  </div>

  <!-- Password -->
  <div class="flex flex-column items-center my-3">
    <label for="password" class="w-4/12 font-bold text-right pr-3">Contraseña:</label>
    <input type="password" class="w-8/12 rounded border-2 border-gray-300 px-3 py-2" name="password" required />
  </div>

  <!-- Submit -->
  <div class="form__control--submit">
    <input type="submit" name="create_user_form" class="bg-green-500 py-2 w-full rounded text-white"
        value="Crear cuenta" />
  </div>

  <div class="flex justify-center my-3">
    <a href="<?php echo base_url('/') ?>" class="font-bold">¿Ya tienes una cuenta?</a>
  </div>
</form>

<?= $this->endSection() ?>