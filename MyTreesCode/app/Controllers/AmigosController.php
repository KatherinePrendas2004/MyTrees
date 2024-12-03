<?php
namespace App\Controllers;

use App\Models\AmigosModel;
use App\Models\ArbolesModel;
use App\Models\ActualizacionesModel;



class AmigosController extends BaseController
{
    public function index()
    {
        $session = session();

        // Verificar autenticación y rol
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        // Obtener la lista de amigos
        $amigosModel = new AmigosModel();
        $data['amigos'] = $amigosModel->obtenerAmigos();

        // Cargar la vista
        return view('amigosAdmin/ListaAmigos', $data);
    }
    
    
}
