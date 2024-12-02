<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    // Método para insertar un usuario
    public function insertUsuario($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    // Método para verificar las credenciales de inicio de sesión
    public function verificarCredenciales($correo, $password)
    {
        // Obtiene el usuario por correo
        $usuario = $this->where('correo', $correo)->first();

        // Compara la contraseña directamente en texto plano
        if ($usuario && $usuario['password'] === $password) {
            return $usuario; // Devuelve los datos del usuario si las credenciales coinciden
        }

        return null; // Devuelve null si las credenciales son incorrectas
    }

    // Obtiene todos los usuarios
    public function obtenerUsuarios()
    {
         return $this->findAll();
    }
 
    // Edita un usuario existente
    public function editarUsuario($id, $data)
    {
         return $this->db->table($this->table)->where('id', $id)->update($data);
    }
 
    // Elimina un usuario
    public function eliminarUsuario($id)
    {
         return $this->db->table($this->table)->where('id', $id)->delete();
    }
 
}
