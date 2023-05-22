<?= $this->extend('default') ?>

<?= $this->section('main') ?>
<form action="auth/login" method="post" class="min-w-[400px] bg-white rounded p-10 shadow-md">
    <h2 class="font-bold text-xl text-center">Iniciar sesión</h2>

    <!-- Email -->
    <div class="flex flex-column items-center my-3">
        <label for="email" class="w-4/12 font-bold text-right pr-3">Email:</label>
        <input type="email" class="w-8/12 border-2 border-gray-300 rounded px-3 py-2" name="email" required />
    </div>

    <!-- Password -->
    <div class="flex flex-column items-center my-3">
        <label for="password" class="w-4/12 font-bold text-right pr-3">Contraseña:</label>
        <input type="password" class="w-8/12 border-2 border-gray-300 rounded px-3 p-2" name="password" required />
    </div>

    <!-- Submit -->
    <div class="my-3">
        <input type="submit" class="bg-green-500 rounded shadow px-3 py-2 w-full text-center text-white"
            value="Iniciar sesión" />
    </div>

    <div class="mt-3 flex justify-center">
        <a href="<?php echo base_url('/users/new') ?>" class="font-bold text-center w-full text-black">Crear
            cuenta</a>
    </div>
</form>

<?= $this->endSection() ?>