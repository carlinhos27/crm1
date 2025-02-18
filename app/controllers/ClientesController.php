<?php
class ClientesController extends Controller
{
    public function index()
    {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->getAllClientes();
        $this->renderView("clientes/index", ["clientes" => $clientes]);
    }

    public function create()
    {
        $operadorModel = new User();
        $empresaModel = new Empresa();

        $operadores = $operadorModel->all(); // Obtener todos los operadores
        $empresas = $empresaModel->all(); // Obtener todas las empresas
        $this->renderView("clientes/crear", [
            "operadores" => $operadores,
            "empresas" => $empresas
        ]);
    }

    public function editar($id)
    {
        $clienteModel = new Cliente();
        $operadorModel = new User();
        $empresaModel = new Empresa();

        $cliente = $clienteModel->find($id); // Buscar cliente por ID
        $operadores = $operadorModel->all();
        $empresas = $empresaModel->all();

        if (!$cliente) {
            die("Cliente no encontrado");
        }

        $this->renderView("clientes/crear", [
            "cliente" => $cliente,
            "operadores" => $operadores,
            "empresas" => $empresas
        ]);
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $clienteModel = new Cliente();
            $clienteModel->update($id, $_POST);
            header("Location: /clientes");
            exit;
        }
    }
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $clienteModel = new Cliente();
            $clienteModel->insert($_POST);
            header("Location: /clientes");
            exit;
        }
    }

    public function destroy($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "DELETE") {
            $clienteModel = new Cliente();
            $deleted = $clienteModel->delete($id);

            if ($deleted) {
                header("Location: /clientes?success=Cliente eliminado");
                exit;
            } else {
                header("Location: /clientes?error=No se pudo eliminar el cliente");
                exit;
            }
        }
    }
}
