<?php
class Empresa extends Model {
    protected $table = 'empresas'; // Nombre de la tabla
    protected $fillable = ['name', 'email', 'password', 'role',  'status']; // Campos permitidos

    // Opcional: Método específico para obtener todos los clientes
    public function getAllEmpresas() {
        return $this->all();
    }
}
