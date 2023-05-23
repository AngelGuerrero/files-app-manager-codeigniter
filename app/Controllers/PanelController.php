<?php

namespace App\Controllers;

use App\Models\UserModel;

class PanelController extends BaseController
{

  public function index()
  {
    $directory_path = ROOTPATH . 'public/uploads';

    $images = [];
    $directory = new \DirectoryIterator($directory_path);

    $user_id = session()->get('user_id');
    $isAdministrator = UserModel::isAdministrator($user_id);

    foreach ($directory as $file) {
      if ($file->isFile() && $this->isImage($file->getExtension())) {
        $file_name = $file->getFilename();
        $split_name = explode('@', $file_name);
        $file_user_id = $split_name[0];

        if ($isAdministrator) {
          $images[] = $file->getFilename();
        } else if ($user_id == $file_user_id) {
          $images[] = $file->getFilename();
        }
      }
    }

    // Pasar la lista de imágenes a la vista
    $data['images'] = $images;
    $data['route'] = 'images/image_list';

    return view('panel\panel', $data);
  }

  public function uploadImage()
  {
    // Validación de la imagen
    $validationRules = [
      'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
    ];

    if (!$this->validate($validationRules)) {
      // Si la validación falla, muestra los errores
      $data['validation'] = $this->validator;
      return redirect()->to('/panel')->with('error', $data['validation']->listErrors());
    }

    $user_id = session()->get('user_id');

    // Si la validación es exitosa, procede a cargar la imagen
    $image = $this->request->getFile('image');

    // Genera un nombre único para la imagen
    $image_name = $user_id . '@' . $image->getRandomName();

    // Mueve la imagen al directorio de destino
    $image->move(ROOTPATH . 'public/uploads', $image_name);

    // Redirige o muestra un mensaje de éxito
    return redirect()->to('/panel')->with('message', 'Imagen cargada correctamente');
  }

  public function deleteImage()
  {
    // Obtén el nombre de la imagen a eliminar (por ejemplo, desde una solicitud POST)
    $image_name = $this->request->getPost('image');
    echo $image_name;

    // Ruta completa del archivo de imagen a eliminar
    $image_path = ROOTPATH . 'public\uploads\\' . $image_name;
    echo $image_path;

    // Verifica si el archivo existe antes de intentar eliminarlo
    if (file_exists($image_path)) {
      // Elimina el archivo de imagen
      unlink($image_path);

      return redirect()->to('/panel')->with('message', 'Imagen eliminada correctamente');
    } else {
      return redirect()->to('/panel')->with('error', 'No se pudo eliminar la imagen');
    }
  }

  private function isImage($extension)
  {
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

    return in_array(strtolower($extension), $allowedExts);
  }
}