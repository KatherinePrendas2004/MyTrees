<?php
namespace App\Controllers;

use App\Models\DashboardModel;

class DashboardController extends BaseController
{
    public function indexAdmin()
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de admin
        if (!$session->get('logged_in') || $session->get('user_role') !== 'admin') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        // Obtiene las estadísticas
        $model = new DashboardModel();
        $data = [
            'amigos' => $model->getAmigosRegistrados(),
            'arboles_disponibles' => $model->getArbolesDisponibles(),
            'arboles_vendidos' => $model->getArbolesVendidos(),
        ];

        // Carga la vista con los datos
        return view('dashboard/tableroAdmin', $data);
    }

    public function indexOperador()
    {
        $session = session();

        // Verifica si el usuario está autenticado y tiene rol de operador
        if (!$session->get('logged_in') || $session->get('user_role') !== 'operador') {
            return redirect()->to('/usuarios/login')->with('error', 'Acceso denegado');
        }

        // Obtiene las estadísticas
        $model = new DashboardModel();
        $data = [
            'amigos_registrados' => $model->getAmigosRegistrados(),
            'arboles_disponibles' => $model->getArbolesDisponibles(),
        ];

        // Carga la vista con los datos
        return view('dashboard/tableroOperador', $data);
    }
}

