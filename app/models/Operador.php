<?php
class Operador extends Model {
    protected $table = 'operadores'; // Nombre de la tabla
    protected $fillable = ['user_id', 'empresa_id', 'estado']; // Campos permitidos

    // Opcional: Método específico para obtener todos los clientes
    public function getAllEmpresas() {
        return $this->all();
    }
}
