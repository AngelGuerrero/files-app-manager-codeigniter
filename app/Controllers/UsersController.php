<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    /**
     * Muestra la lista de usuarios
     */
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('user\user_list', $data);
    }

    /** 
     * Muestra el formulario para crear un nuevo usuario
     */
    public function new()
    {
        return view('user\user_new_form');
    }

    /**
     * Crea un nuevo usuario
     */
    public function create()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $userModel->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        return redirect()->to('user\user_list')->with('message', 'Usuario creado correctamente');
    }

    /**
     * Elimina un usuario
     */
    public function delete($id = null)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('user\user_list')->with('message', 'Usuario eliminado correctamente');
    }
}