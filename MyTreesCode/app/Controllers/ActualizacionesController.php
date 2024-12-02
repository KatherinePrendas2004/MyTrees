<?php

namespace App\Controllers;

use App\Models\ArbolesModel;
use App\Models\ActualizacionesModel;

class ActualizacionesController extends BaseController
{
    public function index($arbolId)
    {
        $session = session();

        // Verificar autenticación y rol
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $arbolesModel = new ArbolesModel();
        $actualizacionesModel = new ActualizacionesModel();

        // Obtener información del árbol
        $arbol = $arbolesModel->find($arbolId);

        if (!$arbol) {
            return redirect()->back()->with('error', 'El árbol no existe.');
        }

        // Obtener historial de actualizaciones
        $actualizaciones = $actualizacionesModel->obtenerHistorialPorArbol($arbolId);

        // Cargar la vista
        return view('amigosAdmin/actualizaciones', [
            'arbol' => $arbol,
            'actualizaciones' => $actualizaciones,
        ]);
    }

    public function agregarActualizacion()
    {
        $data = [
            'arbol_id' => $this->request->getPost('arbol_id'),
            'amigo_id' => $this->request->getPost('amigo_id'),
            'especie_id' => $this->request->getPost('especie_id'),
            'tamanio' => $this->request->getPost('tamanio'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
        ];
    
        // Manejar la foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid()) {
            $nuevoNombre = $foto->getRandomName();
            $foto->move('uploads', $nuevoNombre);
            $data['foto'] = 'uploads/' . $nuevoNombre;
        } else {
            $data['foto'] = $this->request->getPost('existing_foto'); // Mantén la foto existente si no se selecciona una nueva
        }
    
        // Inserta la actualización
        $actualizacionesModel = new ActualizacionesModel();
        if ($actualizacionesModel->insert($data)) {
            return redirect()->back()->with('success', 'Actualización registrada con éxito.');
        } else {
            return redirect()->back()->with('error', 'Error al registrar la actualización.');
        }
    }
}
