<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model
{
    protected $table = 'compras'; // Nombre de la tabla
    protected $primaryKey = 'id';
    protected $allowedFields = ['arbol_id', 'amigo_id', 'fecha_compra'];
}