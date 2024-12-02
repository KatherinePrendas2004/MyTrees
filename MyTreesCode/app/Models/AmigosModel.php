<?php
namespace App\Models;

use CodeIgniter\Model;

class AmigosModel extends Model
{
    protected $table = 'usuarios'; // Tabla de usuarios

    // Obtiene todos los usuarios que son amigos
    public function obtenerAmigos()
    {
        return $this->where('rol', 'amigo')->findAll(); // Filtra solo usuarios con rol 'amigo'
    }
}

