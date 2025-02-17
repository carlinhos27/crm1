<?php
class ClientesController extends Controller {
    public function index() {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->getAllClientes();
        $this->renderView("clientes/index", ["clientes" => $clientes]);
    }

    public function create() {
        $this->renderView("clientes/crear");
    }

    public function store() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $clienteModel = new Cliente();
            $clienteModel->insert($_POST);
            header("Location: /clientes");
            exit;
        }
    }
}
