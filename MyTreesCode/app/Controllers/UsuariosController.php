<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    public function index()
    {
        // Carga la vista del formulario de registro
        return view('usuarios/registro');
    }

    public function registrar()
    {
        try {
            // Obtiene los datos del formulario
            $data = [
                'nombre'    => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellidos'),
                'telefono'  => $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion'),
                'pais'      => $this->request->getPost('pais'),
                'correo'    => $this->request->getPost('correo'),
                'password'  => $this->request->getPost('password'), // Guarda la contraseña sin encriptar
                'rol'       => 'amigo',
            ];

            // Modelo
            $usuariosModel = new UsuariosModel();

            // Intenta insertar el usuario
            if ($usuariosModel->insertUsuario($data)) {
                // Redirige con un mensaje de éxito
                return redirect()->to('/usuarios/registro')->with('success', 'Usuario registrado correctamente');
            } else {
                // Redirige con un mensaje de error
                return redirect()->back()->withInput()->with('error', 'No se pudo registrar el usuario.');
            }
        } catch (\Exception $e) {
            // En caso de error inesperado
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function login()
    {
        // Carga la vista del formulario de inicio de sesión
        return view('usuarios/login');
    }

    public function autenticar()
    {
        $correo = $this->request->getPost('correo');
        $password = $this->request->getPost('password');
    
        $model = new \App\Models\UsuariosModel();
        $usuario = $model->verificarCredenciales($correo, $password);
    
        if ($usuario) {
            $session = session();
            $session->set([
                'user_id' => $usuario['id'],
                'user_name' => $usuario['nombre'],
                'user_role' => $usuario['rol'],
                'logged_in' => true,
            ]);
    
            // Redirige según el rol del usuario
            if ($usuario['rol'] === 'admin') {
                return redirect()->to('/dashboard/tableroAdmin');
            } elseif ($usuario['rol'] === 'operador') {
                return redirect()->to('/dashboard/tableroOperador');
            } elseif ($usuario['rol'] === 'amigo') {
                return redirect()->to('/compraArboles/arboles_disponibles'); // Ruta actualizada
            }
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }
    }
    

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/usuarios/login')->with('success', 'Has cerrado sesión correctamente');
    }
}
