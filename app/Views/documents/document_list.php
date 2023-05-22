<div class="bg-white rounded w-[90%] max-w-[900px] p-5 shadow-md">

  <!-- Formulario para capturar nombre, edad y lugar de residencia -->
  <form action="/documents/generate" method="post" class="min-w-[400px] bg-white p-10 rounded-md shadow-md">
    <h2 class="font-bold text-xl text-center text-gray-700">Crear documento</h2>

    <!-- name -->
    <div class="flex flex-column items-center my-3">
      <label for="name" class="w-4/12 font-bold text-right pr-3">Nombre:</label>
      <input placeholder="Nombre" type="text" class="w-8/12 rounded border-2 border-gray-300 px-3 py-2" name="name"
          required />
    </div>

    <!-- Edad -->
    <div class="flex flex-column items-center my-3">
      <label for="age" class="w-4/12 font-bold text-right pr-3">Edad:</label>
      <input placeholder="25" type="number" class="w-8/12 rounded border-2 border-gray-300 px-3 py-2" name="age"
          required />
    </div>

    <!-- Residencia -->
    <div class="flex flex-column items-center my-3">
      <label for="city" class="w-4/12 font-bold text-right pr-3">Ciudad:</label>
      <input type="text" placeholder="Guadalajara" class="w-8/12 rounded border-2 border-gray-300 px-3 py-2" name="city"
          required />
    </div>

    <!-- Submit -->
    <input type="submit" class="bg-green-500 py-2 w-full rounded text-white" value="Generar documentos" />
  </form>


  <!-- Lista todos los documentos en el servidor -->
  <div class="mt-3 min-w-[400px] bg-white p-10 rounded-md shadow-md">
    <h1 class="font-bold text-xl">Listado de documentos</h1>

    <?php if (!empty($documents)): ?>
      <div class="grid grid-cols-3 gap-4 mt-5">
        <?php foreach ($documents as $document): ?>
          <div class="bg-gray-100 rounded shadow-md p-5 flex flex-col justify-between">
            <div class="flex justify-center">
              <h3 class="font-bold">
                <?php echo $document; ?>
              </h3>
            </div>

            <div class="flex justify-center my-3">
              <a href="<?php echo base_url('uploads/' . $document); ?>"
                  class="bg-blue-500 text-white px-3 py-2 rounded shadow-md">
                Descargar
              </a>

              <form action="/documents/delete" method="post">
                <input type="hidden" name="document" value="<?php echo $document; ?>" />
                <input type="submit" value="Eliminar" class="bg-red-500 text-white px-3 py-2 rounded shadow-md ml-3" />
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="mt-5">No hay documentos subidos.</p>
      <?php endif; ?>
    </div>
  </div>