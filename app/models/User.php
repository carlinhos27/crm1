<?php
class User extends Model {
    protected $table = 'users'; // Nombre de la tabla
    protected $fillable = ['user_id', 'empresa_id', 'estado']; // Campos permitidos

    // Opcional: Método específico para obtener todos los clientes
    public function getAllEmpresas() {
        return $this->all();
    }
}
