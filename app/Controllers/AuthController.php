<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // verifica si el usuario existe en la base de datos
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // verifica si la contraseña es correcta
            if ($user['password'] == $password) {
                // inicia una sesión y guarda el nombre de usuario en las cookies
                $session = session();
                $session->set('user', $user['name']);
                $session->set('isLoggedIn', true);

                // redirige a la página de inicio
                return redirect()->to('/panel')->with('message', 'Sesión iniciada correctamente');
            } else {
                // si no existe, muestra un mensaje de error
                return redirect()->back()->with('error', 'Contraseña incorrecta');
            }
        } else {
            // si no existe, muestra un mensaje de error
            return redirect()->back()->with('error', 'El usuario no existe');
        }
    }

    public function logout()
    {
        // destruye la sesión
        $session = session();
        $session->destroy();

        // redirige a la página de inicio
        return redirect()->to('/')->with('message', 'Sesión cerrada correctamente');
    }
}