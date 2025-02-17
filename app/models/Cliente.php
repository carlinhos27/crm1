<?php
class Cliente extends Model {
    protected $table = 'clientes'; // Nombre de la tabla
    protected $fillable = ['nombre', 'email', 'telefono', 'direccion', 'operador_id', 'estado','empresa_id']; // Campos permitidos

    // Opcional: Método específico para obtener todos los clientes
    public function getAllClientes() {
        return $this->all();
    }
}
