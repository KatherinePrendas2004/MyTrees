<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    protected $table = 'usuarios';

    public function getAmigosRegistrados()
    {
        return $this->db->table('usuarios')
                        ->where('rol', 'amigo')
                        ->countAllResults();
    }

    public function getArbolesDisponibles()
    {
        return $this->db->table('arboles')
                        ->where('estado', 'Disponible')
                        ->countAllResults();
    }

    public function getArbolesVendidos()
    {
        return $this->db->table('arboles')
                        ->where('estado', 'Vendido')
                        ->countAllResults();
    }

}
