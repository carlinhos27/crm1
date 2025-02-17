<?php
class ClientesController extends Controller {
    public function index() {
        $clienteModel = $this->loadModel("Cliente");
        $clientes = $clienteModel->getAllClientes();
        $this->renderView("clientes/index", ["clientes" => $clientes]);
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $clienteModel = $this->loadModel("Cliente");
            $clienteModel->addCliente($_POST);
            header("Location: /clientes");
        }
        $this->renderView("clientes/create");
    }
}
