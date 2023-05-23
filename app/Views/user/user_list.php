<?= $this->extend('default'); ?>

<?= $this->section('main'); ?>
<section class="border rounded shadow-md w-[80%] max-w-[800px] bg-white p-5">
  <h1 class="text-2xl font-bold mb-3">Listado de Usuarios</h1>

  <article class="shadow p-3 rounded">
    <?php if (isset($users) && !empty($users)): ?>
      <div class="">
        <div class="flex w-full justify-around bg-blue-700 rounded p-2 text-white font-bold">
          <div>ID</div>
          <div>Nombre</div>
          <div>Correo Electrónico</div>
          <?php if ($isAdministrator): ?>
            <div>Acciones</div>
          <?php endif; ?>
        </div>

        <?php foreach ($users as $user): ?>
          <div class="flex w-full justify-around bg-white rounded p-2 text-black text-center">
            <div>
              <?= $user['id']; ?>
            </div>
            <div>
              <?= $user['name']; ?>
            </div>
            <div>
              <?= $user['email']; ?>
            </div>
            <?php if ($isAdministrator): ?>
              <div>
                <form action="users/delete/<?= $user['id']; ?>" method="post">
                  <input type="hidden" name="_method" value="DELETE" />
                  <input type="submit" value="Eliminar" <?php if ($user['id'] == session()->get('user_id'))
                    echo 'disabled="disabled"'; ?>
                      class="<?=
                        $user['id'] === session()->get('user_id')
                        ? 'px-3 py-1 border border-gray-500 text-gray-500 border-1 border-gray-300 rounded'
                        : 'px-3 py-1 border border-red-500 text-red-500 border-1 border-red-300 rounded hover:bg-red-500 hover:text-white'; ?>" />
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>No hay usuarios registrados.</p>
    <?php endif; ?>
  </article>
</section>
<?= $this->endSection(); ?>