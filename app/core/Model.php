<?php
class Model {
    protected $db;
    protected $table = ''; // Nombre de la tabla (definido en cada modelo hijo)
    protected $fillable = []; // Campos permitidos para inserción/actualización

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // 🔹 Método para ejecutar consultas y retornar el statement
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // 🔹 Obtener un solo registro
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener múltiples registros
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Ejecutar una consulta (INSERT, UPDATE, DELETE)
    public function execute($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // 🔹 Obtener el ID de la última inserción
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    // 🔹 Obtener todos los registros de la tabla
    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->fetchAll($sql);
    }

    // 🔹 Obtener un registro por ID
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->fetch($sql, ['id' => $id]);
    }

    // 🔹 Insertar un registro
    public function insert($data) {
        $fields = array_intersect_key($data, array_flip($this->fillable));
        $columns = implode(', ', array_keys($fields));
        $placeholders = implode(', ', array_map(fn($col) => ":$col", array_keys($fields)));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $this->execute($sql, $fields);
        return $this->lastInsertId();
    }

    // 🔹 Actualizar un registro
    public function update($id, $data) {
        $fields = array_intersect_key($data, array_flip($this->fillable));
        $setClause = implode(', ', array_map(fn($col) => "$col = :$col", array_keys($fields)));
        $fields['id'] = $id;

        $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";
        return $this->execute($sql, $fields);
    }

    // 🔹 Eliminar un registro
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->execute($sql, ['id' => $id]);
    }
}
