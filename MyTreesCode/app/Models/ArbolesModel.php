<?php
namespace App\Models;

use CodeIgniter\Model;

class ArbolesModel extends Model
{
    protected $table = 'arboles'; // Nombre de la tabla
    protected $primaryKey = 'id';
    protected $allowedFields = ['especie_id', 'ubicacion_geografica', 'estado', 'precio', 'foto'];

    // Método para obtener árboles con información de especie
    public function obtenerArbolesConEspecies()
    {
        return $this->select('arboles.*, especies.nombre_comercial AS nombre_comercial')
                    ->join('especies', 'arboles.especie_id = especies.id', 'left')
                    ->findAll();
    }

    public function obtenerArbolesPorAmigo($amigoId)
    {
        return $this->select('arboles.id, arboles.ubicacion_geografica, arboles.estado, arboles.precio, arboles.foto, arboles.especie_id, especies.nombre_comercial AS especie')
                    ->join('especies', 'arboles.especie_id = especies.id') // Relación con la tabla de especies
                    ->join('compras', 'arboles.id = compras.arbol_id') // Relación con la tabla de compras
                    ->where('compras.amigo_id', $amigoId) // Filtra por el amigo
                    ->findAll();
    }

    public function obtenerArbolesConActualizaciones($amigoId)
    {
        // Obtener árboles que pertenecen al amigo
        $arboles = $this->select('arboles.id, arboles.ubicacion_geografica, arboles.estado, arboles.precio, arboles.foto, arboles.especie_id, especies.nombre_comercial AS especie')
            ->join('especies', 'arboles.especie_id = especies.id')
            ->join('compras', 'arboles.id = compras.arbol_id')
            ->where('compras.amigo_id', $amigoId)
            ->findAll();

        // Buscar actualizaciones para cada árbol
        foreach ($arboles as &$arbol) {
            $actualizacion = $this->db->table('actualizaciones')
                ->where('arbol_id', $arbol['id'])
                ->orderBy('fecha_actualizacion', 'DESC')
                ->get()
                ->getRowArray();

            if ($actualizacion) {
                $arbol['tamanio'] = $actualizacion['tamanio'];
                $arbol['fecha_actualizacion'] = $actualizacion['fecha_actualizacion'];
                $arbol['foto_actualizacion'] = $actualizacion['foto'];
            } else {
                $arbol['tamanio'] = 'No registro';
                $arbol['fecha_actualizacion'] = 'No registro';
                $arbol['foto_actualizacion'] = 'No registro';
            }
        }

        return $arboles;
    }

    public function obtenerArbolesDisponibles()
    {
        return $this->select('arboles.id, arboles.foto, especies.nombre_comercial AS especie, arboles.ubicacion_geografica, arboles.estado, arboles.precio')
                    ->join('especies', 'arboles.especie_id = especies.id')
                    ->where('arboles.estado', 'disponible') // Nota: 'disponible' en minúscula para coincidir con tu base de datos
                    ->findAll();
    }

    public function obtenerDetallesArbol($id, $amigoId)
    {
        return $this->select('arboles.id, arboles.foto, arboles.ubicacion_geografica, arboles.estado, arboles.precio, especies.nombre_comercial AS especie')
                    ->join('especies', 'arboles.especie_id = especies.id')
                    ->join('compras', 'arboles.id = compras.arbol_id')
                    ->where('arboles.id', $id)
                    ->where('compras.amigo_id', $amigoId) // Verifica que el árbol pertenece al amigo
                    ->first();
    }

    public function obtenerHistorialActualizaciones($arbolId)
    {
        return $this->db->table('actualizaciones')
                        ->select('tamanio, foto, fecha_actualizacion')
                        ->where('arbol_id', $arbolId)
                        ->orderBy('fecha_actualizacion', 'DESC') // Ordena por las actualizaciones más recientes
                        ->get()
                        ->getResultArray();
    }


    public function agregarActualizacion($data)
    {
        return $this->db->table('actualizaciones')->insert($data);
    }

    // Agrega un nuevo árbol
    public function agregarArbol($data)
    {
        return $this->insert($data);
    }

    // Edita un árbol existente
    public function editarArbol($id, $data)
    {
        return $this->update($id, $data);
    }

    // Elimina un árbol
    public function eliminarArbol($id)
    {
        return $this->delete($id);
    }
}

