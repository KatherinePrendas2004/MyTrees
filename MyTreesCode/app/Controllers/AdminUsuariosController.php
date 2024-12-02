<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class AdminUsuariosController extends BaseController
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $model = new UsuariosModel();
        $data['usuarios'] = $model->obtenerUsuarios();

        return view('adminUsuarios/admin_usuarios', $data);
    }

    public function agregar()
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $data = [
            'nombre'    => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'telefono'  => $this->request->getPost('telefono'),
            'correo'    => $this->request->getPost('correo'),
            'direccion' => $this->request->getPost('direccion'),
            'pais'      => $this->request->getPost('pais'),
            'password'  => $this->request->getPost('password'), // Contraseña en texto plano
            'rol'       => $this->request->getPost('rol'),
        ];

        $model = new UsuariosModel();
        if ($model->insertUsuario($data)) {
            return redirect()->to('/adminUsuarios/admin_usuarios')->with('success', 'Usuario agregado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al agregar el usuario');
        }
    }

    public function editar($id)
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $data = [
            'nombre'    => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'telefono'  => $this->request->getPost('telefono'),
            'correo'    => $this->request->getPost('correo'),
            'direccion' => $this->request->getPost('direccion'),
            'pais'      => $this->request->getPost('pais'),
            'rol'       => $this->request->getPost('rol'),
        ];

        $model = new UsuariosModel();
        if ($model->editarUsuario($id, $data)) {
            return redirect()->to('/adminUsuarios/admin_usuarios')->with('success', 'Usuario actualizado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el usuario');
        }
    }

    public function eliminar($id)
    {
        $session = session();

        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $model = new UsuariosModel();
        if ($model->eliminarUsuario($id)) {
            return redirect()->to('/adminUsuarios/admin_usuarios')->with('success', 'Usuario eliminado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el usuario');
        }
    }
}
