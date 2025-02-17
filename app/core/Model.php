<?php
class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Método para ejecutar consultas y retornar el statement
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // Obtener un solo registro
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener múltiples registros
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ejecutar una consulta (INSERT, UPDATE, DELETE)
    public function execute($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Obtener el ID de la última inserción
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}
