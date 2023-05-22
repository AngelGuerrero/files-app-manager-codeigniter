<div class="bg-white rounded w-[90%] max-w-[900px] p-5 shadow-md">
  <h1 class="font-bold text-xl">Listado de imágenes</h1>

  <?= $this->include('images/image_upload') ?>

  <?php if (!empty($images)): ?>
    <div class="grid grid-cols-3 gap-4 mt-5">
      <?php foreach ($images as $image): ?>
        <div class="bg-gray-100 rounded shadow-md p-5 flex flex-col justify-between">
          <div class="flex justify-center">
            <img src="<?php echo base_url('uploads/' . $image); ?>" alt="<?php echo $image; ?>"
                class="w-[200px] h-[200px] object-cover" />
          </div>

          <div class="flex justify-center my-3">
            <a href="<?php echo base_url('uploads/' . $image); ?>"
                class="bg-blue-500 text-white px-3 py-2 rounded shadow-md">
              Descargar
            </a>

            <form action="/panel/delete" method="post">
              <input type="hidden" name="image" value="<?php echo $image; ?>" />
              <input type="submit" value="Eliminar" class="bg-red-500 text-white px-3 py-2 rounded shadow-md ml-3" />
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="mt-5">No hay documentos subidos.</p>
  <?php endif; ?>
</div>