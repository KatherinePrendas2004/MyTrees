<?php
namespace App\Controllers;

use App\Models\ArbolesModel;
use App\Models\EspeciesModel;

class ArbolesController extends BaseController
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $arbolesModel = new ArbolesModel();
        $especiesModel = new EspeciesModel();

        // Carga los datos de árboles y especies
        $data['arboles'] = $arbolesModel->obtenerArbolesConEspecies();
        $data['especies'] = $especiesModel->findAll();

        return view('arbolesAdmin/crud_arboles', $data);
    }

    public function agregar()
    {
        $arbolesModel = new ArbolesModel();

        // Manejar subida de imagen
        $file = $this->request->getFile('foto');
        $rutaFoto = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Ruta de destino dentro de la carpeta `uploads`
            $nombreArchivo = $file->getRandomName();
            $rutaFoto = 'uploads/' . $nombreArchivo;

            // Mover el archivo a la carpeta pública
            $file->move(FCPATH . 'uploads', $nombreArchivo);
        } else {
            // Si no hay archivo subido, podrías asignar una imagen por defecto
            $rutaFoto = null;
        }

        // Preparar datos para insertar en la base de datos
        $data = [
            'especie_id' => $this->request->getPost('especie_id'),
            'ubicacion_geografica' => $this->request->getPost('ubicacion_geografica'),
            'estado' => $this->request->getPost('estado'),
            'precio' => $this->request->getPost('precio'),
            'foto' => $rutaFoto, // Se guarda la ruta de la foto
        ];

        if ($arbolesModel->insert($data)) {
            return redirect()->to('/arbolesAdmin/crud_arboles')->with('success', 'Árbol agregado correctamente');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al agregar el árbol');
        }
    }


    public function editar($id)
    {
        $arbolesModel = new ArbolesModel();

        // Obtener el archivo subido
        $file = $this->request->getFile('foto');
        $rutaFoto = $this->request->getPost('existing_foto'); // Imagen existente

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Si se sube una nueva imagen, se reemplaza la existente
            $nombreArchivo = $file->getRandomName();
            $rutaFoto = 'uploads/' . $nombreArchivo;
            $file->move(FCPATH . 'uploads', $nombreArchivo);
        }

        $data = [
            'especie_id' => $this->request->getPost('especie_id'),
            'ubicacion_geografica' => $this->request->getPost('ubicacion_geografica'),
            'estado' => $this->request->getPost('estado'),
            'precio' => $this->request->getPost('precio'),
            'foto' => $rutaFoto,
        ];

        if ($arbolesModel->update($id, $data)) {
            return redirect()->to('/arbolesAdmin/crud_arboles')->with('success', 'Árbol actualizado correctamente');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el árbol');
        }
    }


    public function eliminar($id)
    {
        $arbolesModel = new ArbolesModel();

        if ($arbolesModel->eliminarArbol($id)) {
            return redirect()->to('/arbolesAdmin/crud_arboles')->with('success', 'Árbol eliminado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el árbol');
        }
    }
    
    public function verArboles($amigoId)
    {
        $session = session();
    
        // Verificar autenticación y rol
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }
    
        // Modelos para árboles y actualizaciones
        $arbolesModel = new \App\Models\ArbolesModel();
        $actualizacionesModel = new \App\Models\ActualizacionesModel();
    
        // Obtener los árboles del amigo
        $arboles = $arbolesModel->obtenerArbolesPorAmigo($amigoId);
    
        // Agregar información de la última actualización a cada árbol
        foreach ($arboles as &$arbol) {
            $ultimaActualizacion = $actualizacionesModel->obtenerUltimaActualizacion($arbol['id']);
            if ($ultimaActualizacion) {
                $arbol['tamanio'] = $ultimaActualizacion['tamanio'];
                $arbol['fecha_actualizacion'] = $ultimaActualizacion['fecha_actualizacion'];
                $arbol['foto'] = $ultimaActualizacion['foto'];
            } else {
                // Valores predeterminados si no hay actualizaciones
                $arbol['tamanio'] = 'Sin registro';
                $arbol['fecha_actualizacion'] = 'Sin registro';
                $arbol['foto'] = null;
            }
    
            // Agregar el historial completo (necesario para el modal)
            $arbol['historial'] = $actualizacionesModel->obtenerHistorial($arbol['id']);
        }
    
        // Cargar la vista
        return view('amigosAdmin/arboles', [
            'amigo_id' => $amigoId,
            'arboles' => $arboles,
        ]);
    }

    public function arbolesDisponibles()
    {
        $session = session();

        // Verificar que el usuario sea del tipo "amigo"
        if (!$session->get('logged_in') || $session->get('user_role') !== 'amigo') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        // Obtener los árboles disponibles
        $arbolesModel = new ArbolesModel();
        $arbolesDisponibles = $arbolesModel->obtenerArbolesDisponibles();

        // Cargar la vista con los datos
        return view('compraArboles/arboles_disponibles', ['arboles_disponibles' => $arbolesDisponibles]);
    }


    public function confirmarCompra()
    {
        $session = session();

        // Verificar que el usuario esté autenticado
        if (!$session->get('logged_in') || $session->get('user_role') !== 'amigo') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        $comprasModel = new \App\Models\ComprasModel();
        $arbolesModel = new \App\Models\ArbolesModel();

        // Capturar el ID del árbol
        $arbolId = $this->request->getPost('arbol_id');

        // Verificar si el árbol está disponible antes de procesar la compra
        $arbol = $arbolesModel->find($arbolId);

        if (!$arbol || $arbol['estado'] !== 'disponible') {
            return redirect()->back()->with('error', 'El árbol ya no está disponible.');
        }

        // Datos para insertar en la tabla `compras`
        $data = [
            'arbol_id' => $arbolId,
            'amigo_id' => $session->get('user_id'), // ID del usuario logueado
        ];

        if ($comprasModel->insert($data)) {
            // Cambiar el estado del árbol a "vendido"
            $arbolesModel->update($arbolId, ['estado' => 'vendido']);

            return redirect()->to('/compraArboles/arboles_disponibles')->with('success', 'Compra realizada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al realizar la compra.');
        }
    }

}

