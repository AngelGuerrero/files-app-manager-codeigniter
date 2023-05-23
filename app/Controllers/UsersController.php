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
        $user_id = session()->get('user_id');
        $data['isAdministrator'] = UserModel::isAdministrator(session()->get('user_id'));

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

        return redirect()->to('/')->with('message', 'Usuario creado correctamente');
    }

    /**
     * Elimina un usuario
     */
    public function delete($id = null)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        $data['message'] = 'Usuario eliminado correctamente';
        $data['route'] = 'user\user_list';

        return redirect()->to('/users')->with('message', 'Usuario eliminado correctamente');
    }
}