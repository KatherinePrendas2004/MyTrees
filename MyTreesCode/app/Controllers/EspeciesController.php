<?php

namespace App\Controllers;

use App\Models\EspeciesModel;

class EspeciesController extends BaseController
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        // Obtiene la lista de especies
        $model = new EspeciesModel();
        $data['especies'] = $model->findAll();

        // Carga la vista
        return view('especiesAdmin/crud_especies', $data);
    }

    public function agregar()
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $model = new EspeciesModel();

        $data = [
            'nombre_comercial' => $this->request->getPost('nombre_comercial'),
            'nombre_cientifico' => $this->request->getPost('nombre_cientifico'),
        ];

        if ($model->agregarEspecie($data)) {
            return redirect()->to('/especiesAdmin/crud_especies')->with('success', 'Especie agregada correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al agregar la especie');
        }
    }

    public function editar($id)
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $model = new EspeciesModel();

        $data = [
            'nombre_comercial' => $this->request->getPost('nombre_comercial'),
            'nombre_cientifico' => $this->request->getPost('nombre_cientifico'),
        ];

        if ($model->editarEspecie($id, $data)) {
            return redirect()->to('/especiesAdmin/crud_especies')->with('success', 'Especie actualizada correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al editar la especie');
        }
    }

    public function eliminar($id)
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $model = new EspeciesModel();

        if ($model->eliminarEspecie($id)) {
            return redirect()->to('/especiesAdmin/crud_especies')->with('success', 'Especie eliminada correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar la especie');
        }
    }
}
