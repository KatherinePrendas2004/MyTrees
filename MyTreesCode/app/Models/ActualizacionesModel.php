<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\ActualizacionesModel;

class ActualizacionesModel extends Model
{
    protected $table = 'actualizaciones';
    protected $primaryKey = 'id_registro';

    protected $allowedFields = [
        'arbol_id',
        'amigo_id',
        'especie_id',
        'tamanio',
        'ubicacion_geografica',
        'estado',
        'fecha_actualizacion',
        'foto',
    ];

    /**
     * Obtiene la última actualización de un árbol.
     *
     * @param int $arbolId
     * @return array|null
     */
    public function obtenerUltimaActualizacion($arbolId)
    {
        return $this->where('arbol_id', $arbolId)
                    ->orderBy('fecha_actualizacion', 'DESC')
                    ->first(); // Devuelve la última actualización
    }

    public function obtenerHistorial($arbolId)
    {
        return $this->where('arbol_id', $arbolId)
                    ->orderBy('fecha_actualizacion', 'DESC')
                    ->findAll();
    }

    public function obtenerHistorialPorArbol($arbolId)
    {
        return $this->where('arbol_id', $arbolId)
                    ->orderBy('fecha_actualizacion', 'DESC')
                    ->findAll();
    }
    
}
