<?php

namespace App\Models;

use CodeIgniter\Model;

class EspeciesModel extends Model
{
    protected $table = 'especies'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Obtiene todas las especies
    public function obtenerEspecies()
    {
        return $this->findAll();
    }

    // Agrega una nueva especie
    public function agregarEspecie($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    // Edita una especie existente
    public function editarEspecie($id, $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    // Elimina una especie
    public function eliminarEspecie($id)
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }
}
